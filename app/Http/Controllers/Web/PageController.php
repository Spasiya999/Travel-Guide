<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\InquiryReceived;
use App\Models\Category;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        return view('web.pages.about_us');
    }

    public function packages(Request $request)
    {
        try {
            $query = Service::where('status', 1)->with('category', 'testimonials');
            $categories = Category::where('status', 1)->get();

            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }

            $packages = $query->get();
            return view('web.pages.packages', compact('packages', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function tour()
    {
        $testimonials = Testimonial::where('status', 1)->where('is_approved', 1)->get();
        return view('web.pages.tour', compact('testimonials'));
    }

    public function contact()
    {
        $services = Service::where('status', 1)->get();
        return view('web.pages.contact_us', compact('services'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:30',
            'country'     => 'required|string|max:100',
            'date'        => 'nullable|string|max:255',
            'group_size'  => 'required|integer|min:1',
            'message'     => 'required|string|max:2000',
            'service_id'  => 'required|exists:services,id',
        ]);

        $inquiry = Inquiry::create($validated);

        Mail::to('admin@example.com')->send(new InquiryReceived($inquiry));

        return redirect()->back()->with('success', 'Your inquiry has been submitted!');
    }
}
