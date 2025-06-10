<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // List all testimonials
    public function index()
    {
        $testimonials = Testimonial::with(['service', 'category'])->latest()->get();
        $services = Service::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.testimonials.index', compact('testimonials', 'services', 'categories'));
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'message'     => 'required|string',
            'country'     => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'rating'      => 'nullable|integer|min:1|max:5',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'user_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_approved' => 'required|boolean',
            'service_id'  => 'nullable|exists:services,id',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        if ($request->hasFile('user_image')) {
            $validated['user_image'] = $request->file('user_image')->store('testimonials/users', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial added successfully.');
    }

    // Show form to edit a testimonial
    public function edit(Testimonial $testimonial)
    {
        $services = Service::all();
        $categories = Category::all();
        return view('admin.testimonials.edit', compact('testimonial', 'services', 'categories'));
    }

    // Update an existing testimonial
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'message'     => 'required|string',
            'country'     => 'nullable|string|max:100',
            'date'        => 'nullable|date',
            'rating'      => 'nullable|integer|min:1|max:5',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'user_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_approved' => 'required|boolean',
            'service_id'  => 'nullable|exists:services,id',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        if ($request->hasFile('user_image')) {
            $validated['user_image'] = $request->file('user_image')->store('testimonials/users', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated successfully.');
    }

    // Delete a testimonial
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully.');
    }
}
