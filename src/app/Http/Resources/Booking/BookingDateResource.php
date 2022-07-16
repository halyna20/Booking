<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\User\UserResource;
use App\Models\BookingRoom;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'is_approved' => $this->is_approved,
            'booking_room' => BookingRoomResource::collection($this->whenLoaded(('booking_rooms')))
        ];
    }
}
