<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

        return view('web.home.home', compact('categories', 'services', 'places', 'testimonials'));
    }
}
