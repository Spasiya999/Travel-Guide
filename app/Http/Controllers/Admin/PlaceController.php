<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Display a listing of the places
    public function index()
    {
        $places = Place::latest()->get();
        return view('admin.places.index', compact('places'));
    }

    // Store a newly created place
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/places/'), $imageName);
            $imagePath = 'images/uploads/places/' . $imageName;
            $validated['image'] = $imagePath;
        }

        Place::create($validated);

        return redirect()->route('admin.places')->with('success', 'Place created successfully.');
    }

    // Update the specified place
    public function update(Request $request, Place $place)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/places/'), $imageName);
            $imagePath = 'images/uploads/places/' . $imageName;
            $validated['image'] = $imagePath;
        }

        $place->update($validated);

        return redirect()->route('admin.places')->with('success', 'Place updated successfully.');
    }

    // Remove the specified place
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('admin.places')->with('success', 'Place deleted successfully.');
    }
}
