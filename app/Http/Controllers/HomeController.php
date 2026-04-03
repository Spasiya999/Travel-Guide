<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Place;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status', 1)->where('is_popular', 1)->take(6)->get();
        $services = Service::where('status', 1)->take(4)->get();
        $places = Place::where('status', 1)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $galleries = Gallery::where('status', 1)->where('is_featured', 1)->get();

        $metaData = [
            "title" => "Explore Trails Ceylon Tours | Sri Lanka Travel Guide & Holiday Packages",
            "description" => "Explore Trails Ceylon Tours offers expertly crafted Sri Lanka travel packages and guided tours. Discover beaches, culture, wildlife, and hidden gems across the island.",
            "keywords" => "Explore Trails Ceylon, Explore Trails Ceylon Tours, Sri Lanka travel guide, Sri Lanka tour packages, holiday trips, adventure tours, cultural tours"
        ];

        return view('web.home.home', compact('categories', 'services', 'places', 'testimonials', 'galleries', 'metaData'));
    }
}
