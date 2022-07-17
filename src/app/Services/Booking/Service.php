<?php

namespace App\Services\Booking;

use App\Models\BookingDate;
use App\Models\BookingRoom;
use App\Services\Base\MySqlService;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Service extends MySqlService
{
    protected BookingDate $bookingDate;
    protected BookingRoom $bookingRoom;


    public function __construct(BookingDate $bookingDate, BookingRoom $bookingRoom)
    {
        $this->bookingDate = $bookingDate;
        $this->bookingRoom = $bookingRoom;
    }

    public function createBooking($data)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $roomBooking = Arr::pluck($data->bookingRooms, 'room_id');

            if ($this->bookingRoom->whereIn('id', $roomBooking)) {

                if (
                    ($this->bookingDate->date_from >= $data->userData['dateFrom'] &&
                        $this->bookingDate->date_to >= $data->userData['dateTo'] ||
                        $this->bookingDate->date_from <= $data->userData['dateFrom'] &&
                        $this->bookingDate->date_to <= $data->userData['dateTo'] ||
                        $this->bookingDate->date_from >= $data->userData['dateFrom'] &&
                        $this->bookingDate->date_to <= $data->userData['dateTo']) &&
                    $this->bookingDate->is_approved === 1
                ) {

                    return response()->json(['error' => 'Вже заброньовано']);
                }
            }

            $bookingDate = $user->booking_dates()->create([
                'date_from' => $data->userData['dateFrom'],
                'date_to' => $data->userData['dateTo']
            ]);

            foreach ($data->bookingRooms as $room) {
                $this->bookingRoom->create([
                    'booking_date_id' => $bookingDate['id'],
                    'room_id' => $room['room_id']
                ]);
            }

            DB::commit();

            return $bookingDate;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $bookingDate =  $user->booking_dates()->findOrFail($id);
            $bookingDate->delete($id);
            DB::commit();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
