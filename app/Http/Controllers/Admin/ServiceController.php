<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index()
    {
        $services = Service::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.services.index', compact('services', 'categories'));
    }

    // Show the form for creating a new service
    public function create()
    {
        return view('admin.services.create', compact('categories'));
    }

    // Store a newly created service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'duration'          => 'nullable|string|max:100',
            'category_id'       => 'nullable|exists:categories,id',
            'status'            => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/services/'), $imageName);
            $imagePath = 'images/uploads/services/' . $imageName;
            $validated['image'] = $imagePath;
        }

        Service::create($validated);

        return redirect()->route('admin.services')->with('success', 'Service created successfully.');
    }

    // Show the form for editing the specified service
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('services.edit', compact('service', 'categories'));
    }

    // Update the specified service
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'duration'          => 'nullable|string|max:100',
            'category_id'       => 'nullable|exists:categories,id',
            'status'            => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/services/'), $imageName);
            $imagePath = 'images/uploads/services/' . $imageName;
            $validated['image'] = $imagePath;
        }

        $service->update($validated);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully.');
    }

    // Remove the specified service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully.');
    }

    // Optionally show a single service
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }
}
