<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourismItem;
use Illuminate\Http\Request;

class TourismItemController extends Controller
{
    public function index(Request $request)
    {
        $query = TourismItem::query();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $tourismItems = $query->orderBy('type')->orderBy('name')->paginate(20);

        return view('admin.tourism-items.index', compact('tourismItems'));
    }

    public function create()
    {
        return view('admin.tourism-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:national_park,heritage_site,activity',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price_usd' => 'required|numeric|min:0',
            'price_lkr' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'requires_transport' => 'boolean',
            'features' => 'nullable|array',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['features'] = $request->features ?? [];

        TourismItem::create($data);

        return redirect()->route('admin.tourism-items.index')
            ->with('success', 'Tourism item created successfully!');
    }

    public function show(TourismItem $tourismItem)
    {
        return view('admin.tourism-items.show', compact('tourismItem'));
    }

    public function edit(TourismItem $tourismItem)
    {
        return view('admin.tourism-items.edit', compact('tourismItem'));
    }

    public function update(Request $request, TourismItem $tourismItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:national_park,heritage_site,activity',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price_usd' => 'required|numeric|min:0',
            'price_lkr' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'requires_transport' => 'boolean',
            'features' => 'nullable|array',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['features'] = $request->features ?? [];

        $tourismItem->update($data);

        return redirect()->route('admin.tourism-items.index')
            ->with('success', 'Tourism item updated successfully!');
    }

    public function destroy(TourismItem $tourismItem)
    {
        // Check if item is used in any quotations
        if ($tourismItem->quotations()->exists()) {
            return back()->with('error', 'Cannot delete item that is used in quotations.');
        }

        $tourismItem->delete();

        return back()->with('success', 'Tourism item deleted successfully!');
    }

    public function bulkUpdatePrices(Request $request)
    {
        $request->validate([
            'type' => 'nullable|in:national_park,heritage_site,activity',
            'percentage' => 'required|numeric|min:-100|max:1000',
            'currency' => 'required|in:usd,lkr,both'
        ]);

        $query = TourismItem::active();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $items = $query->get();
        $percentage = $request->percentage / 100;

        foreach ($items as $item) {
            if ($request->currency === 'usd' || $request->currency === 'both') {
                $item->price_usd = $item->price_usd * (1 + $percentage);
            }

            if ($request->currency === 'lkr' || $request->currency === 'both') {
                $item->price_lkr = $item->price_lkr * (1 + $percentage);
            }

            $item->save();
        }

        return back()->with('success', 'Prices updated successfully for ' . $items->count() . ' items.');
    }

    public function export()
    {
        $tourismItems = TourismItem::orderBy('type')->orderBy('name')->get();

        $csv = "Name,Type,Description,Location,Price USD,Price LKR,Duration,Requires Transport,Status\n";

        foreach ($tourismItems as $item) {
            $csv .= '"' . $item->name . '",';
            $csv .= '"' . $item->getTypeDisplayName() . '",';
            $csv .= '"' . ($item->description ?? '') . '",';
            $csv .= '"' . ($item->location ?? '') . '",';
            $csv .= $item->price_usd . ',';
            $csv .= $item->price_lkr . ',';
            $csv .= '"' . ($item->duration ?? '') . '",';
            $csv .= ($item->requires_transport ? 'Yes' : 'No') . ',';
            $csv .= ucfirst($item->status) . "\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="tourism-items-' . now()->format('Y-m-d') . '.csv"');
    }
}
