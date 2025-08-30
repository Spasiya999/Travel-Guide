<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Quotation;
use App\Models\QuotationDay;
use App\Models\QuotationEvent;
use App\Models\QuotationVehicle;
use App\Models\Vehicle;
use App\Models\TourismItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function create(Request $request, $inquiryId)
    {
        $inquiry = Inquiry::with('service.category')->findOrFail($inquiryId);

        // Get suggested vehicles based on group size
        $suggestedVehicles = Vehicle::suggestForGroupSize($inquiry->group_size);
        $allVehicles = Vehicle::where('status', 'active')->get();

        // Get tourism items categorized
        $nationalParks = TourismItem::active()->nationalParks()->get();
        $heritageSites = TourismItem::active()->heritageSites()->get();
        $activities = TourismItem::active()->activities()->get();
        $allTourismItems = TourismItem::active()->orderBy('type')->orderBy('name')->get();

        return view('admin.quotations.create', compact(
            'inquiry',
            'suggestedVehicles',
            'allVehicles',
            'nationalParks',
            'heritageSites',
            'activities',
            'allTourismItems'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required|exists:inquiries,id',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'valid_days' => 'required|integer|min:1',
            'notes' => 'nullable|string',

            // Days validation
            'days' => 'required|array|min:1',
            'days.*.title' => 'required|string',
            'days.*.description' => 'required|string',
            'days.*.location' => 'required|string',
            'days.*.accommodation' => 'nullable|string',
            'days.*.meals_included' => 'nullable|array',
            'days.*.activities' => 'nullable|array',
            'days.*.transport' => 'nullable|string',
            'days.*.cost_per_person' => 'required|numeric|min:0',

            // Events validation
            'events' => 'nullable|array',
            'events.*.event_name' => 'required_with:events|string',
            'events.*.event_date' => 'required_with:events|date',
            'events.*.location' => 'required_with:events|string',
            'events.*.description' => 'required_with:events|string',
            'events.*.duration' => 'required_with:events|string',
            'events.*.cost_per_person' => 'required_with:events|numeric|min:0',
            'events.*.is_optional' => 'nullable|boolean',

            // Vehicles validation
            'vehicles' => 'nullable|array',
            'vehicles.*.vehicle_id' => 'required_with:vehicles|exists:vehicles,id',
            'vehicles.*.days_assigned' => 'required_with:vehicles|array',
            'vehicles.*.pickup_location' => 'required_with:vehicles|string',
            'vehicles.*.dropoff_location' => 'required_with:vehicles|string',
            'vehicles.*.estimated_km' => 'required_with:vehicles|integer|min:0',
            'vehicles.*.driver_required' => 'nullable|boolean',
            'vehicles.*.special_requirements' => 'nullable|string',

            // Tourism items validation
            'tourism_items' => 'nullable|array',
            'tourism_items.*.tourism_item_id' => 'required_with:tourism_items|exists:tourism_items,id',
            'tourism_items.*.quantity' => 'required_with:tourism_items|integer|min:1',
            'tourism_items.*.is_optional' => 'nullable|boolean',
            'tourism_items.*.custom_details' => 'nullable|string',
        ]);

        // Create quotation
        $quotation = new Quotation();
        $quotation->inquiry_id = $request->inquiry_id;
        $quotation->quotation_number = $quotation->generateQuotationNumber();
        $quotation->currency = $request->currency;
        $quotation->total_amount = 0;
        $quotation->tourism_items_total = 0;
        $quotation->valid_until = Carbon::now()->addDays((int) $request->valid_days);
        $quotation->notes = $request->notes;
        $quotation->created_by = auth()->user()->name ?? 'System';
        $quotation->save();

        $daysTotalCost = 0;
        // Create quotation days
        foreach ($request->days as $index => $dayData) {
            QuotationDay::create([
                'quotation_id' => $quotation->id,
                'day_number' => $index + 1,
                'title' => $dayData['title'],
                'description' => $dayData['description'],
                'location' => $dayData['location'],
                'accommodation' => $dayData['accommodation'] ?? null,
                'meals_included' => $dayData['meals_included'] ?? [],
                'activities' => $dayData['activities'] ?? [],
                'transport' => $dayData['transport'] ?? null,
                'cost_per_person' => $dayData['cost_per_person'],
            ]);

            $daysTotalCost += $dayData['cost_per_person'];
        }

        $eventsTotalCost = 0;
        // Create quotation events if provided
        if ($request->has('events') && is_array($request->events)) {
            foreach ($request->events as $eventData) {
                QuotationEvent::create([
                    'quotation_id' => $quotation->id,
                    'event_name' => $eventData['event_name'],
                    'event_date' => $eventData['event_date'],
                    'location' => $eventData['location'],
                    'description' => $eventData['description'],
                    'duration' => $eventData['duration'],
                    'cost_per_person' => $eventData['cost_per_person'],
                    'is_optional' => $eventData['is_optional'] ?? false,
                ]);

                if (!($eventData['is_optional'] ?? false)) {
                    $eventsTotalCost += $eventData['cost_per_person'];
                }
            }
        }

        $vehiclesTotalCost = 0;
        // Create quotation vehicles if provided
        if ($request->has('vehicles') && is_array($request->vehicles)) {
            foreach ($request->vehicles as $vehicleData) {
                $vehicle = Vehicle::findOrFail($vehicleData['vehicle_id']);

                $daysCost = count($vehicleData['days_assigned']) * $vehicle->cost_per_day;
                $kmCost = $vehicleData['estimated_km'] * $vehicle->cost_per_km;
                $totalCost = $daysCost + $kmCost;

                QuotationVehicle::create([
                    'quotation_id' => $quotation->id,
                    'vehicle_id' => $vehicleData['vehicle_id'],
                    'days_assigned' => $vehicleData['days_assigned'],
                    'pickup_location' => $vehicleData['pickup_location'],
                    'dropoff_location' => $vehicleData['dropoff_location'],
                    'estimated_km' => $vehicleData['estimated_km'],
                    'driver_required' => $vehicleData['driver_required'] ?? true,
                    'special_requirements' => $vehicleData['special_requirements'] ?? null,
                    'cost_per_day' => $vehicle->cost_per_day,
                    'total_cost' => $totalCost,
                ]);

                $vehiclesTotalCost += $totalCost;
            }
        }

        $tourismItemsTotalCost = 0;
        // Create quotation tourism items if provided
        if ($request->has('tourism_items') && is_array($request->tourism_items)) {
            foreach ($request->tourism_items as $tourismItemData) {
                $tourismItem = TourismItem::findOrFail($tourismItemData['tourism_item_id']);

                $total_price = $tourismItemData['quantity'] * ($request->currency === 'USD' ? $tourismItem->price_usd : $tourismItem->price_lkr);

                $quotation->tourismItems()->attach($tourismItem->id, [
                    'quantity' => $tourismItemData['quantity'],
                    'unit_price' => $request->currency === 'USD' ? $tourismItem->price_usd : $tourismItem->price_lkr,
                    'total_price' => $total_price,
                    'custom_details' => $tourismItemData['custom_details'] ?? null,
                    'is_optional' => $tourismItemData['is_optional'] ?? false,
                ]);

                if (!($tourismItemData['is_optional'] ?? false)) {
                    $tourismItemsTotalCost += $total_price;
                }
            }
        }

        // Calculate final total
        $groupSize = $quotation->inquiry->group_size;
        $finalTotalAmount = ($daysTotalCost * $groupSize) +
            ($eventsTotalCost * $groupSize) +
            $vehiclesTotalCost +
            $tourismItemsTotalCost;

        $quotation->total_amount = $finalTotalAmount;
        $quotation->tourism_items_total = $tourismItemsTotalCost;
        $quotation->save();

        return redirect()->route('admin.quotations.show', $quotation->id)
            ->with('success', 'Quotation created successfully!');
    }

    public function show($id)
    {
        $quotation = Quotation::with([
            'inquiry.service.category',
            'days',
            'events',
            'vehicles.vehicle',
            'tourismItems'
        ])->findOrFail($id);

        return view('admin.quotations.show', compact('quotation'));
    }

    public function showByInquiry($inquiryId)
    {
        $quotation = Quotation::with([
            'inquiry.service.category',
            'days',
            'events',
            'vehicles.vehicle',
            'tourismItems'
        ])->where('inquiry_id', $inquiryId)->firstOrFail();

        return view('admin.quotations.show', compact('quotation'));
    }

    public function generatePDF($id)
    {
        $quotation = Quotation::with([
            'inquiry.service.category',
            'days',
            'events',
            'vehicles.vehicle',
            'tourismItems'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.quotations', compact('quotation'));

        return $pdf->download('quotation-' . $quotation->quotation_number . '.pdf');
    }

    public function sendToClient($id)
    {
        $quotation = Quotation::with([
            'inquiry.service.category',
            'days',
            'events',
            'vehicles.vehicle',
            'tourismItems'
        ])->findOrFail($id);

        // Generate PDF
        $pdf = PDF::loadView('pdf.quotations', compact('quotation'));

        // Send email with PDF attachment
        // You'll need to implement email sending logic here

        $quotation->update(['status' => 'sent']);

        return back()->with('success', 'Quotation sent to client successfully!');
    }

    // API endpoint to get vehicles for group size
    public function getVehiclesForGroupSize(Request $request)
    {
        $groupSize = $request->input('group_size');
        $suggestedVehicles = Vehicle::suggestForGroupSize($groupSize);

        return response()->json([
            'vehicles' => $suggestedVehicles->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'name' => $vehicle->name,
                    'type' => $vehicle->type,
                    'capacity' => $vehicle->capacity,
                    'cost_per_day' => $vehicle->cost_per_day,
                    'cost_per_km' => $vehicle->cost_per_km,
                    'features' => $vehicle->features,
                    'driver_included' => $vehicle->driver_included,
                ];
            })
        ]);
    }

    // API endpoint to get tourism items by type
    public function getTourismItemsByType(Request $request)
    {
        $type = $request->input('type');
        $currency = $request->input('currency', 'LKR');

        $items = TourismItem::active();

        if ($type) {
            $items = $items->byType($type);
        }

        $items = $items->get();

        return response()->json([
            'items' => $items->map(function ($item) use ($currency) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => $item->type,
                    'price' => $item->getPriceInCurrency($currency),
                    'duration' => $item->duration,
                    'features' => $item->features,
                ];
            })
        ]);
    }
}
