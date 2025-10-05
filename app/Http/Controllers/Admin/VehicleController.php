<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:car,van,minibus,bus,coach,luxury_car,suv',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'cost_per_day' => 'required|numeric|min:0',
            'cost_per_km' => 'nullable|numeric|min:0',
            'fuel_type' => 'required|in:petrol,diesel,hybrid,electric',
            'status' => 'required|in:active,inactive,maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle checkboxes - they're not included in request if unchecked
        $data['ac_available'] = $request->has('ac_available') ? 1 : 0;
        $data['driver_included'] = $request->has('driver_included') ? 1 : 0;

        // Set default value for cost_per_km if null
        $data['cost_per_km'] = $data['cost_per_km'] ?? 0;

        // Handle image upload - saves directly to public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/vehicles'), $imageName);
            $data['image'] = 'uploads/vehicles/' . $imageName;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:car,van,minibus,bus,coach,luxury_car,suv',
                'capacity' => 'required|integer|min:1',
                'description' => 'required|string',
                'cost_per_day' => 'required|numeric|min:0',
                'cost_per_km' => 'nullable|numeric|min:0',
                'fuel_type' => 'required|in:petrol,diesel,hybrid,electric',
                'status' => 'required|in:active,inactive,maintenance',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle checkboxes - they're not included in request if unchecked
            $data['ac_available'] = $request->has('ac_available') ? 1 : 0;
            $data['driver_included'] = $request->has('driver_included') ? 1 : 0;

            // Set default value for cost_per_km if null
            $data['cost_per_km'] = $data['cost_per_km'] ?? 0;

            // Handle image upload - saves directly to public folder
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($vehicle->image && file_exists(public_path($vehicle->image))) {
                    unlink(public_path($vehicle->image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/vehicles'), $imageName);
                $data['image'] = 'uploads/vehicles/' . $imageName;
            }

            $vehicle->update($data);

            return redirect()->route('admin.vehicles')->with('success', 'Vehicle updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Vehicle update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while updating the vehicle.')
                ->withInput();
        }
    }

    public function toggleStatus(Vehicle $vehicle)
    {
        try {
            $newStatus = $vehicle->status === 'active' ? 'inactive' : 'active';
            $vehicle->update(['status' => $newStatus]);

            $statusText = $newStatus === 'active' ? 'activated' : 'deactivated';

            return redirect()->route('admin.vehicles')
                ->with('success', "Vehicle has been {$statusText} successfully.");
        } catch (\Exception $e) {
            Log::error('Vehicle status toggle error: ' . $e->getMessage());
            return redirect()->route('admin.vehicles')
                ->with('error', 'An error occurred while updating the vehicle status.');
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        try {
            Log::info('=== Vehicle Deletion Process Started ===');
            Log::info('Vehicle ID: ' . $vehicle->id);
            Log::info('Vehicle Name: ' . $vehicle->name);

            // Check if vehicle is used in any quotations
            $quotationCount = $vehicle->quotationVehicles()->count();
            Log::info('Quotation Vehicles Count: ' . $quotationCount);

            if ($vehicle->quotationVehicles()->exists()) {
                $quotationIds = $vehicle->quotationVehicles()->pluck('quotation_id')->implode(', ');

                Log::warning('Vehicle deletion blocked - vehicle is used in quotations');
                Log::info('Related Quotation IDs: ' . $quotationIds);

                return redirect()->route('admin.vehicles')
                    ->with('error', "Cannot delete this vehicle because it is being used in {$quotationCount} quotation(s) (IDs: {$quotationIds}). Please deactivate it instead.");
            }

            Log::info('No quotations found, proceeding with deletion');

            // Check and delete image
            if ($vehicle->image) {
                Log::info('Vehicle has image: ' . $vehicle->image);
                $imagePath = public_path($vehicle->image);
                Log::info('Image path: ' . $imagePath);

                if (file_exists($imagePath)) {
                    Log::info('Image file exists, attempting to delete');
                    unlink($imagePath);
                    Log::info('Image deleted successfully');
                } else {
                    Log::warning('Image file does not exist at path: ' . $imagePath);
                }
            } else {
                Log::info('No image associated with this vehicle');
            }

            // Delete vehicle
            Log::info('Attempting to delete vehicle from database');
            $vehicle->delete();
            Log::info('Vehicle deleted successfully from database');
            Log::info('=== Vehicle Deletion Process Completed ===');

            return redirect()->route('admin.vehicles')
                ->with('success', 'Vehicle deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('=== Database Error During Vehicle Deletion ===');
            Log::error('Error Code: ' . $e->getCode());
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('SQL: ' . $e->getSql());

            return redirect()->route('admin.vehicles')
                ->with('error', 'Database error: Cannot delete vehicle due to foreign key constraint.');
        } catch (\Exception $e) {
            Log::error('=== General Error During Vehicle Deletion ===');
            Log::error('Error Type: ' . get_class($e));
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Error File: ' . $e->getFile());
            Log::error('Error Line: ' . $e->getLine());
            Log::error('Stack Trace: ' . $e->getTraceAsString());

            return redirect()->route('admin.vehicles')
                ->with('error', 'An error occurred while deleting the vehicle. Please check logs.');
        }
    }
}
