<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $guarded = false;

    //protected $casts = [
    //    'image' => AsCollection::class
    //];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getSearch($value)
    {
        return $this->select('apartments.*')
            ->leftJoin('cities', 'apartments.city_id', '=', 'cities.id')
            ->leftJoin('rooms', 'apartments.id', '=', 'rooms.apartment_id')
            ->where('cities.name', 'like', '%' . $value['city'] . '%')
            ->where('rooms.number_of_adults', '>=', $value['adult'])
            ->where('rooms.number_of_children', '>=', $value['child'])
            ->groupBy('apartments.id')->get();
    }
}
