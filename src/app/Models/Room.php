<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function booking_rooms()
    {
        return $this->hasMany(BookingRoom::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getRoomCountWithApartmentId($apartmentId, $value)
    {
        return $this->select('apartment_id')->whereIn('apartment_id', $apartmentId)
            ->leftJoin('offers', 'rooms.id', '=', 'offers.room_id')
            ->whereDate('offers.date_from', '<=', $value['dateFrom'])
            ->whereDate('offers.date_to', '>=', $value['dateTo'])
            ->whereNotExists(function ($query) use ($value) {
                $query->from('booking_dates')
                    ->where('is_approved', 1)
                    ->where(function ($q) use ($value) {
                        $q->whereDate('booking_dates.date_from', '<=', $value['dateFrom'])
                            ->whereDate('booking_dates.date_to', '>=', $value['dateFrom'])
                            ->orWhereDate('booking_dates.date_from', '<=', $value['dateTo'])
                            ->whereDate('booking_dates.date_to', '>=', $value['dateTo'])
                            ->orWhereDate('booking_dates.date_from', '<=', $value['dateFrom'])
                            ->whereDate('booking_dates.date_to', '>=', $value['dateTo']);
                    });
            })
            ->selectRaw('count(rooms.id) as rooms_count')
            ->groupBy('apartment_id')->get();
    }

    public function getRoomByApartment($apartmentId, $value)
    {
        return $this->where('apartment_id', $apartmentId)
            ->where('number_of_adults', '>=', $value['adult'])
            ->where('number_of_children', '>=', $value['child'])
            ->leftJoin('offers', 'rooms.id', '=', 'offers.room_id')
            ->whereDate('date_from', '<=', $value['dateFrom'])
            ->whereDate('date_to', '>=', $value['dateTo'])
            ->get();
    }
}
