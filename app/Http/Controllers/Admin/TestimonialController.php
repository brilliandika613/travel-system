<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        // Tampilkan semua testimoni, urutkan pending dulu
        $testimonials = Testimonial::with('user', 'tour')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Testimoni berhasil disetujui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}