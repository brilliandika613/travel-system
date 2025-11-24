<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
       $tours = Tour::all();
        $destinations = Destination::take(6)->get();
        $testimonials = Testimonial::where('status', 'approved')->take(6)->get();

        return view('welcome', compact('tours', 'destinations', 'testimonials'));
    }
}