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
        $galleries = Gallery::where('status',1)->where('is_featured', 1)->get();

        $metaData = [
            "title" => "Home - Travel Guide",
            "description" => "Welcome to our travel guide. Explore our services, popular categories, and featured places.",
            "keywords" => "travel guide, home, services, categories, places"
        ];

        return view('web.home.home', compact('categories', 'services', 'places', 'testimonials', 'galleries', 'metaData'));
    }
}
