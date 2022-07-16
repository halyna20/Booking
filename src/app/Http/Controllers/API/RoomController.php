<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Resources\Room\RoomCollection;
use App\Services\Room\Service;


class RoomController extends Controller
{


    protected Service $roomService;

    public function __construct(Service $roomService)
    {

        $this->roomService = $roomService;
    }

    public function store($apartmentId, RoomRequest $request)
    {
        $data = $request->validated();
        $room = $this->roomService->store($apartmentId, $data);
        return new RoomCollection($room);
    }
}
