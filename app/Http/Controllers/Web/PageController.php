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
            "title" => "About Us - Explore Trails Ceylon Tours",
            "description" => "Learn more about Explore Trails Ceylon Tours — our mission, vision, and the passionate team dedicated to creating exceptional travel experiences across Sri Lanka.",
            "keywords" => "about Explore Trails Ceylon Tours, travel agency Sri Lanka, our mission, tourism experts, Sri Lanka tours"
        ];
        return view('web.pages.about_us', compact('metaData'));
    }

    public function packages(Request $request)
    {
        try {

            $metaData = [
                "title" => "Packages - Explore Trails Ceylon Tours",
                "description" => "Explore our exclusive Sri Lanka tour packages. Whether it’s adventure, culture, or relaxation, we have the perfect itinerary for you.",
                "keywords" => "Sri Lanka travel packages, holiday tours, adventure trips, Explore Trails Ceylon Tours, tour itineraries"
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
            "title" => "Tours & Reviews - Explore Trails Ceylon Tours",
            "description" => "Read authentic reviews from travelers and explore our guided tours across Sri Lanka. Experience the best with Explore Trails Ceylon Tours.",
            "keywords" => "Sri Lanka tours, travel reviews, customer testimonials, Explore Trails Ceylon Tours, travel experiences"
        ];

        $testimonials = Testimonial::where('status', 1)->where('is_approved', 1)->get();
        $galleries = Gallery::where('status', 1)->get();
        return view('web.pages.tour', compact('testimonials', 'galleries', 'metaData'));
    }

    public function contact()
    {
        $metaData = [
            "title" => "Contact Us - Explore Trails Ceylon Tours",
            "description" => "Contact Explore Trails Ceylon Tours for inquiries, custom packages, or support. We’re here to help you plan your perfect Sri Lanka adventure.",
            "keywords" => "contact Explore Trails Ceylon Tours, travel inquiries, customer support, Sri Lanka tours"
        ];

        $services = Service::where('status', 1)->get();
        return view('web.pages.contact_us', compact('services', 'metaData'));
    }

    public function places()
    {
        $metaData = [
            "title" => "Places - Explore Trails Ceylon Tours",
            "description" => "Discover the most beautiful places in Sri Lanka. Explore destinations, cultural highlights, and natural wonders with Explore Trails Ceylon Tours.",
            "keywords" => "Sri Lanka destinations, tourist places, Explore Trails Ceylon Tours, travel spots, sightseeing"
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

        Mail::to($inquiry->email)->send(new InquiryReceived($inquiry));

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
        $whatsappNumber = '94701070007';

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
