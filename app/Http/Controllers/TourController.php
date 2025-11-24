<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // Tampilkan semua paket tour
    public function index()
{
    $tours = Tour::all();
    return view('tours.index', compact('tours'));
}

// API untuk ambil tour berdasarkan type
public function showByType($type)
{
    if (!in_array($type, ['domestic', 'international'])) {
        abort(404);
    }

    $tours = Tour::where('type', $type)->paginate(12);
    $title = $type === 'domestic' ? 'Tour Domestik' : 'Tour Internasional';

    return view('tours.index', compact('tours', 'title'));
}

    // Tampilkan detail tour berdasarkan slug
    public function show(Tour $tour)
    {
        return view('tours.show', compact('tour'));
    }
}