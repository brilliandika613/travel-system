<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTours = Tour::count();
        $totalDestinations = Destination::count();
        $totalTestimonials = Testimonial::count();

        return view('admin.dashboard', compact(
            'totalTours',
            'totalDestinations',
            'totalTestimonials'
        ));
    }
}