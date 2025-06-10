<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    // Display a listing of inquiries
    public function index()
    {
        $inquiries = Inquiry::with('service')->latest()->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }
}
