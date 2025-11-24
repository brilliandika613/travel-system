<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;

class BookingController extends Controller
{
    // Tampilkan form pemesanan
    public function create(Tour $tour)
    {
        return view('bookings.create', compact('tour'));
    }

    // Simpan booking
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'departure_date' => 'required|date|after:today',
            'participants' => 'required|integer|min:1|max:100',
        ]);

        // Ambil tour berdasarkan tour_id
    $tour = Tour::findOrFail($request->tour_id);
    $total = $tour->price * $request->participants;

        $booking = Booking::create([
            'user_id' => Auth::id(), // ✅ Cara paling aman
            'tour_id' => $tour->id,
            'departure_date' => $request->departure_date,
            'participants' => $request->participants,
            'total_price' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('booking.confirm', $booking->id);
    }

    // Halaman konfirmasi & upload bukti
    public function confirm(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return view('bookings.confirm', compact('booking'));
    }

    // Upload bukti pembayaran
    public function uploadProof(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('payment_proof')) {
            $path = $request->file('payment_proof')->store('proofs', 'public');
            $booking->update(['payment_proof' => $path]);
        }

        return redirect()->route('booking.status', $booking->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    // Lihat status pemesanan
    public function status(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return view('bookings.status', compact('booking'));
    }

    // Riwayat pemesanan user
    public function history()
    {
        $bookings = Auth::user()->bookings()->with('tour')->latest()->get();
        return view('bookings.history', compact('bookings'));
    }
}