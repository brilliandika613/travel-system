<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;       // ← tambahkan ini
use App\Models\Testimonial;

class Tour extends Model
{
    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}
}
