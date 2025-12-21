<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;       // ← tambahkan ini
use App\Models\Testimonial;

class Tour extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'duration_days', 'duration_nights', 'min_people','location','category','image_url','rating','reviews_count'
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}
}
