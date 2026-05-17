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
            "title" => "About Explore Trails Ceylon Tours | Sri Lanka Travel Experts & Tour Planners",
            "description" => "Explore Trails Ceylon Tours is a team of Sri Lankan travel experts offering authentic, personalized travel experiences and expertly designed tour packages.",
            "keywords" => "Explore Trails Ceylon Tours, Explore Trails Ceylon, Sri Lanka travel experts, tour planners, travel agency, local guides"
        ];
        return view('web.pages.about_us', compact('metaData'));
    }

    public function packages(Request $request)
    {
        try {

            $metaData = [
                "title" => "Sri Lanka Tour Packages | Explore Trails Ceylon Tours Travel Guide",
                "description" => "Find the best Sri Lanka tour packages at Explore Trails Ceylon. Choose from adventure, cultural, and honeymoon tours tailored to your travel needs.",
                "keywords" => "Explore Trails Ceylon, Explore Trails Ceylon Tours, Sri Lanka tour packages, travel guide, honeymoon tours, adventure tours, cultural trips"
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
            "title" => "Sri Lanka Tours & Reviews | Explore Trails Ceylon Tours",
            "description" => "Read traveler reviews and explore guided tours by Explore Trails Ceylon Tours. Experience Sri Lanka’s top destinations with trusted local travel experts.",
            "keywords" => "Explore Trails Ceylon, Explore Trails Ceylon Tours, Sri Lanka tours, travel reviews, guided tours, local travel experts"
        ];

        $testimonials = Testimonial::where('status', 1)->where('is_approved', 1)->get();
        $galleries = Gallery::where('status', 1)->get();
        return view('web.pages.tour', compact('testimonials', 'galleries', 'metaData'));
    }

    public function contact()
    {
        $metaData = [
            "title" => "Contact Explore Trails Ceylon Tours | Plan Your Sri Lanka Tour",
            "description" => "Contact Explore Trails Ceylon Tours to customize your Sri Lanka holiday package. Get travel assistance, itinerary planning, and expert local support.",
            "keywords" => "Contact Explore Trails Ceylon Tours, Explore Trails Ceylon, Sri Lanka travel guide, custom tour packages, travel planning, travel support"
        ];

        $services = Service::where('status', 1)->get();
        return view('web.pages.contact_us', compact('services', 'metaData'));
    }

    public function places()
    {
        $metaData = [
            "title" => "Best Places to Visit in Sri Lanka | Explore Trails Ceylon Tours",
            "description" => "Discover the best places to visit in Sri Lanka with Explore Trails Ceylon Tours. Explore beaches, heritage sites, wildlife parks, and mountain escapes.",
            "keywords" => "Explore Trails Ceylon, Explore Trails Ceylon Tours, Sri Lanka travel guide, tourist destinations, sightseeing, nature, culture, attractions"
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

    public function importDestinations()
    {
        try {
            $csvFile = database_path('data/destinations.csv');
            if (!file_exists($csvFile)) {
                return response()->json(['success' => false, 'message' => 'CSV file not found.'], 404);
            }

            // Truncate table
            Place::truncate();

            $file = fopen($csvFile, 'r');
            $header = fgetcsv($file); // Skip header

            while (($row = fgetcsv($file)) !== FALSE) {
                Place::create([
                    'name' => $row[0],
                    'slug' => $row[1],
                    'description' => $row[2],
                    'spots' => $row[3],
                    'image' => $row[4],
                    'status' => $row[5],
                ]);
            }

            fclose($file);

            return "✅ Destinations imported successfully! <a href='/'>Go Home</a>";
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function importTestimonials()
    {
        try {
            $csvFile = database_path('data/testimonials.csv');
            if (!file_exists($csvFile)) {
                return response()->json(['success' => false, 'message' => 'CSV file not found.'], 404);
            }

            // Truncate table
            Testimonial::truncate();

            $file = fopen($csvFile, 'r');
            $header = fgetcsv($file); // Skip header

            while (($row = fgetcsv($file)) !== FALSE) {
                Testimonial::create([
                    'name' => $row[0],
                    'message' => $row[1],
                    'country' => $row[2],
                    'date' => $row[3],
                    'rating' => $row[4],
                    'is_approved' => $row[5],
                    'status' => $row[6],
                ]);
            }

            fclose($file);

            return "✅ Testimonials imported successfully! <a href='/'>Go Home</a>";
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
