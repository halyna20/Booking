<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function booking_rooms()
    {
        return $this->hasMany(BookingRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
