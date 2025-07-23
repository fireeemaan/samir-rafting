<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'package_id',
        'booking_date',
        'name',
        'email',
        'phone',
        'participants',
        'status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'participant' => 'integer'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function getTotalPriceAttribute()
    {
        return $this->package->price * $this->participants;
    }
}
