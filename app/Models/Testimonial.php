<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;   // ← tambahkan ini
use App\Models\Tour;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id', 'tour_id', 'name', 'city', 'rating', 'comment', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}