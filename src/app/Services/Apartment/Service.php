<?php

namespace App\Services\Apartment;

use App\Models\Apartment;
use App\Models\Room;
use App\Services\Base\MySqlService;
use Exception;
use Illuminate\Support\Facades\DB;

class Service extends MySqlService
{
    protected Apartment $apartment;
    protected Room $room;

    public function __construct(Apartment $apartment, Room $room)
    {
        $this->apartment = $apartment;
        $this->room = $room;
    }

    public function search($value)
    {
        $apartments = $this->apartment->getSearch($value);

        $apartmentId = $apartments->unique('id')->pluck('id')->toArray();
        $rooms = $this->room->getRoomCountWithApartmentId($apartmentId, $value);

        $filteredByCountRoom = $rooms->where('rooms_count', '>=', $value['roomCount']);
        $roomsApartmentId = $filteredByCountRoom->pluck('apartment_id')->toArray();
        $filteredByDate =  $apartments->whereIn('id', $roomsApartmentId)->values();

        return $filteredByDate;
    }

    public function getApartmentById($apartmentId, $value)
    {
        $rooms = $this->room->getRoomByApartment($apartmentId, $value);
        return $rooms;
    }

    public function store($value)
    {
        DB::beginTransaction();

        try {
            $apartment = $this->apartment->create($value);

            DB::commit();

            return $apartment;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
