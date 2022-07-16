<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingDate;
use App\Models\BookingRoom;
use App\Models\User;
use App\Services\Booking\Service;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected BookingDate $bookingDate;
    protected BookingRoom $bookingRoom;
    protected Service $bookingService;

    public function __construct(BookingDate $bookingDate, BookingRoom $bookingRoom, Service $bookingService)
    {
        $this->bookingDate = $bookingDate;
        $this->bookingRoom = $bookingRoom;
        $this->bookingService = $bookingService;
    }


    public  function createBooking(Request $request)
    {
        $bookingData = $this->bookingService->createBooking($request);
        return $bookingData;
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $bookingDate =  $user->booking_dates()->findOrFail($id);
        $bookingDate->delete($id);


        return response()->json(['message' => "Бронювання скасовано"]);
    }
}
