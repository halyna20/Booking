<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Booking\Service;


class BookingController extends Controller
{

    protected Service $bookingService;

    public function __construct(Service $bookingService)
    {
        $this->bookingService = $bookingService;
    }


    public  function createBooking(Request $request)
    {
        $bookingData = $this->bookingService->createBooking($request);
        return $bookingData;
    }

    public function destroy($id)
    {
        $this->bookingService->destroy($id);

        return response()->json(['message' => "Бронювання скасовано"]);
    }
}
