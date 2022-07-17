<?php

namespace App\Services\User;

use App\Models\Apartment;
use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Base\MySqlService;
use Illuminate\Support\Facades\Auth;

class Service extends MySqlService
{
    protected Room $room;
    protected Apartment $apartment;
    public function __construct(Room $room, Apartment $apartment)
    {
        $this->room = $room;
        $this->apartment = $apartment;
    }

    public function update($data, $user)
    {
        DB::beginTransaction();
        try {
            $user->update($data);
            DB::commit();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function getBooking()
    {
        $user = Auth::user();
        $data = [];
        $booking_dates = $user->booking_dates()->with(["booking_rooms"])->orderBy('date_to', 'DESC')->get();
        if (count($booking_dates) > 0) {
            foreach ($booking_dates as $date) {
                foreach ($date->booking_rooms as $bookingRoom) {
                    $rooms[] = $this->room::where('id', $bookingRoom->room_id)->get(['id', 'apartment_id', 'price'])->toArray();
                }
            }

            for ($i = 0; $i < count($rooms); $i++) {
                for ($j = 0; $j < count($rooms[$i]); $j++) {
                    $apartment[] = $this->apartment::where('id', $rooms[$i][$j]['apartment_id'])->with(["city:id,name"])->get(['id', 'name', 'image', 'city_id']);
                }
            }

            $data['bookingDate'] =  [
                'booking_date' => $booking_dates,
                'rooms' => $rooms,
                'apartment' => $apartment

            ];
        }

        return $data;
    }
}
