<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Tampilkan testimoni publik (hanya yang approved)
    public function publicIndex()
    {
        $testimonials = Testimonial::with('user', 'tour')
            ->where('status', 'approved')
            ->latest()
            ->paginate(6);

        return view('testimonials.index', compact('testimonials'));
    }

    // Tampilkan form kirim testimoni
    public function create(Tour $tour)
    {
        // Opsional: cek apakah user sudah pernah booking tour ini
        return view('testimonials.create', compact('tour'));
    }

    // Simpan testimoni baru
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'city' => 'required|string|max:100',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'tour_id' => $request->tour_id,
            'name' => Auth::user()->name,
            'city' => $request->city,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // menunggu approval admin
        ]);

        return redirect()->route('testimonials.index')
                         ->with('success', 'Terima kasih atas ulasan Anda! Ulasan akan ditampilkan setelah diverifikasi.');
    }
}