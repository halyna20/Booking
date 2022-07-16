<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\Apartment\ApartmentResource;
use App\Http\Resources\Booking\BookingDateResource;
use App\Http\Resources\User\UserResource;
use App\Models\Apartment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAuthorizedUser()
    {
        return  Auth::user() ? new UserResource(Auth::user()) : response()->json(['error' => 'The user is not authorized']);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return new UserResource($user);
    }

    public function getBooking()
    {
        $user = Auth::user();
        $booking_dates = $user->booking_dates()->with(["booking_rooms"])->orderBy('date_to', 'DESC')->get();
        $data = [];
        if (count($booking_dates) > 0) {
            foreach ($booking_dates as $date) {
                foreach ($date->booking_rooms as $bookingRoom) {
                    $rooms[] = Room::where('id', $bookingRoom->room_id)->get(['id', 'apartment_id', 'price'])->toArray();
                }
            }

            for ($i = 0; $i < count($rooms); $i++) {
                for ($j = 0; $j < count($rooms[$i]); $j++) {
                    $apartment[] = Apartment::where('id', $rooms[$i][$j]['apartment_id'])->with(["city:id,name"])->get(['id', 'name', 'image', 'city_id']);
                }
            }

            $data['bookingDate'] =  [
                'booking_date' => $booking_dates,
                'rooms' => $rooms,
                'apartment' => $apartment

            ];
        }



        return $data ? response()->json($data) : response()->json(["message" => "Немає здійснених бронювань"]);
    }
}
