<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    // Display a listing of the galleries
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    // Show the form for creating a new gallery image
    public function create()
    {
        return view('admin.galleries.create');
    }

    // Store a newly created gallery image
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:0,1',
        ], [
            'image.required' => 'Gallery image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be JPG, JPEG, or PNG format.',
            'image.max' => 'Image size must be less than 2MB.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Please select a valid status.',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Check aspect ratio (16:9)
                list($width, $height) = getimagesize($image->getPathname());
                $aspectRatio = $width / $height;
                $expectedRatio = 16 / 9;
                $tolerance = 0.02;

                if (abs($aspectRatio - $expectedRatio) > $tolerance) {
                    return redirect()->back()
                        ->withErrors(['image' => 'Image must be in 16:9 aspect ratio.'])
                        ->withInput()
                        ->with('modal', 'create');
                }

                $imageName = 'gallery_' . time() . '.' . $image->extension();
                $destinationPath = public_path('images/uploads/galleries/');

                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/uploads/galleries/' . $imageName;
                $validated['image'] = $imagePath;
            }

            // Set default value for is_featured if not provided
            $validated['is_featured'] = $validated['is_featured'] ?? 0;

            Gallery::create($validated);

            return redirect()->route('admin.galleries.index')->with('success', 'Gallery image added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while uploading the image. Please try again.'])
                ->withInput()
                ->with('modal', 'create');
        }
    }

    // Show the form for editing the specified gallery image
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    // Update the specified gallery image
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:0,1',
        ], [
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be JPG, JPEG, or PNG format.',
            'image.max' => 'Image size must be less than 2MB.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Please select a valid status.',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Check aspect ratio (16:9)
                list($width, $height) = getimagesize($image->getPathname());
                $aspectRatio = $width / $height;
                $expectedRatio = 16 / 9;
                $tolerance = 0.02;

                if (abs($aspectRatio - $expectedRatio) > $tolerance) {
                    return redirect()->back()
                        ->withErrors(['image' => 'Image must be in 16:9 aspect ratio.'])
                        ->withInput()
                        ->with('modal', 'edit')
                        ->with('edit_gallery_id', $gallery->id);
                }

                // Delete old image if exists
                if ($gallery->image && File::exists(public_path($gallery->image))) {
                    File::delete(public_path($gallery->image));
                }

                $imageName = 'gallery_' . time() . '.' . $image->extension();
                $destinationPath = public_path('images/uploads/galleries/');

                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/uploads/galleries/' . $imageName;
                $validated['image'] = $imagePath;
            }

            // Set default value for is_featured if not provided
            $validated['is_featured'] = $validated['is_featured'] ?? 0;

            $gallery->update($validated);

            return redirect()->route('admin.galleries.index')->with('success', 'Gallery image updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while updating the image. Please try again.'])
                ->withInput()
                ->with('modal', 'edit')
                ->with('edit_gallery_id', $gallery->id);
        }
    }

    // Remove the specified gallery image
    public function destroy(Gallery $gallery)
    {
        try {
            // Delete image file if exists
            if ($gallery->image && File::exists(public_path($gallery->image))) {
                File::delete(public_path($gallery->image));
            }

            $gallery->delete();
            return redirect()->route('admin.galleries.index')->with('success', 'Gallery image deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the image. Please try again.');
        }
    }
}
