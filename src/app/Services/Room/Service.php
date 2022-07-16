<?php

namespace App\Services\Room;

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

    public function store($apartmentId, $data)
    {
        DB::beginTransaction();
        try {
            $apartment = $this->apartment::findOrFail($apartmentId);

            $room = $apartment->rooms()->create($data);

            DB::commit();

            return $room;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
