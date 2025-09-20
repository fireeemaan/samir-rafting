<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'thumbnail',
        'facilities',
        'location_url'
    ];

    protected $casts = [
        'facilities' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function generateUniqueSlug($name) {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function confirmedBookings(): HasMany
    {
        return $this->hasMany(Booking::class)->where('status', 'confirmed');
    }

    public function pendingBookings(): HasMany
    {
        return $this->hasMany(Booking::class)->where('status', 'pending');
    }
}
