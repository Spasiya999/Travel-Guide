<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
            'name' => 'required|string',
            'type' => 'required|in:car,van,minibus,bus,coach,luxury_car,suv',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'cost_per_day' => 'required|numeric|min:0',
            'cost_per_km' => 'nullable|numeric|min:0',
            'fuel_type' => 'required|in:petrol,diesel,hybrid,electric',
            'ac_available' => 'boolean',
            'driver_included' => 'boolean',
            'status' => 'required|in:active,inactive,maintenance',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
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
        $data = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:car,van,minibus,bus,coach,luxury_car,suv',
            'capacity' => 'required|integer|min:1',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'cost_per_day' => 'required|numeric|min:0',
            'cost_per_km' => 'nullable|numeric|min:0',
            'fuel_type' => 'required|in:petrol,diesel,hybrid,electric',
            'ac_available' => 'boolean',
            'driver_included' => 'boolean',
            'status' => 'required|in:active,inactive,maintenance',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles')->with('success', 'Vehicle deleted successfully.');
    }
}
