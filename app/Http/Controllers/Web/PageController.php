<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('web.pages.about_us');
    }

    public function packages() {
        return view('web.pages.packages');
    }

    public function tour() {
        return view('web.pages.tour');
    }

    public function contact() {
        return view('web.pages.contact_us');
    }
}
