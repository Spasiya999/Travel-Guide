<?php

namespace App\Http\Controllers\Web;

use App\Enum\GroupSize;
use App\Http\Controllers\Controller;
use App\Mail\InquiryReceived;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Inquiry;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $metaData = [
            "title" => "About Us - Travel Guide",
            "description" => "Learn more about our travel guide services, our mission, and the team behind it.",
            "keywords" => "about us, travel guide, our mission, team, travel services"
        ];
        return view('web.pages.about_us', compact('metaData'));
    }

    public function packages(Request $request)
    {
        try {

            $metaData = [
                "title" => "Packages - Travel Guide",
                "description" => "Explore our travel packages tailored to your needs. Find the perfect package for your next adventure.",
                "keywords" => "travel packages, tours, adventures, travel guide"
            ];

            $query = Service::where('status', 1)->with('category', 'testimonials');
            $categories = Category::where('status', 1)->get();

            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }

            $packages = $query->get();
            return view('web.pages.packages', compact('packages', 'categories', 'metaData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching packages.');
        }
    }

    public function tour()
    {
        $metaData = [
            "title" => "Tour & Reviews - Travel Guide",
            "description" => "Discover our tours and read reviews from our satisfied customers. Join us for an unforgettable travel experience.",
            "keywords" => "tour, reviews, travel guide, customer testimonials"
        ];

        $testimonials = Testimonial::where('status', 1)->where('is_approved', 1)->get();
        $galleries = Gallery::where('status', 1)->get();
        return view('web.pages.tour', compact('testimonials', 'galleries', 'metaData'));
    }

    public function contact()
    {
        $metaData = [
            "title" => "Contact Us - Travel Guide",
            "description" => "Get in touch with us for inquiries, feedback, or support. We are here to assist you with your travel needs.",
            "keywords" => "contact us, travel guide, inquiries, support"
        ];

        $services = Service::where('status', 1)->get();
        return view('web.pages.contact_us', compact('services', 'metaData'));
    }

    public function places()
    {
        $metaData = [
            "title" => "Places - Travel Guide",
            "description" => "Explore our featured places. Discover the best travel destinations and experiences.",
            "keywords" => "places, travel guide, destinations, travel experiences"
        ];

        $places = Place::where('status', 1)->get();
        return view('web.pages.places', compact('places', 'metaData'));
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

        // Mail::to('admin@example.com')->send(new InquiryReceived($inquiry));

        // Group size
        $groupSize = GroupSize::from($validated['group_size']);

        // Build message
        $message = urlencode("New Inquiry:\n"
            . "Name: {$validated['first_name']} {$validated['last_name']}\n"
            . "Email: {$validated['email']}\n"
            . "Phone: {$validated['phone']}\n"
            . "Country: {$validated['country']}\n"
            . "Date: {$validated['date']}\n"
            . "Group Size: {$groupSize->label()}\n"
            . "Message: {$validated['message']}");

        // WhatsApp number (with country code, no "+" or "00")
        $whatsappNumber = '94763906650';

        // Redirect to WhatsApp
        return redirect("https://wa.me/{$whatsappNumber}?text={$message}");
    }

    public function getPlaces(Request $request)
    {
        try {
            $query = Place::where('id', $request->id)
                ->where('status', 1);

            $places = $query->first();

            return response()->json([
                'success' => true,
                'data' => $places
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
