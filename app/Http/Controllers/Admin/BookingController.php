<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'tour')
            ->latest()
            ->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($booking)
    {
        $booking = Booking::where('id', $booking)->first();
        return view('admin.bookings.show', compact('booking'));
    }

    public function confirm(Booking $booking)
    {
        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'lunas'
        ]);
        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi!');
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Booking ditandai sebagai selesai!');
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Booking dibatalkan.');
    }
}