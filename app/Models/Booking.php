<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;   // ← tambahkan ini
use App\Models\Tour;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'tour_id', 'departure_date', 'participants',
        'total_price', 'status', 'payment_status', 'payment_proof'
    ];
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function tour(): BelongsTo
{
    return $this->belongsTo(Tour::class);
}
}