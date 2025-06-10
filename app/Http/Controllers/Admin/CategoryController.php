<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/categories/'), $imageName);
            $imagePath = 'images/uploads/categories/' . $imageName;
            $validated['image'] = $imagePath;
        }

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    // Update the specified resource in storage.
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'image_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/uploads/categories/'), $imageName);
            $imagePath = 'images/uploads/categories/' . $imageName;
            $validated['image'] = $imagePath;
        }

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
