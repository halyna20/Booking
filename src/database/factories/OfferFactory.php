<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $dateTimeFrom = $this->faker->dateTimeBetween('now', '+5 month');
        $dateTimeTo = (clone $dateTimeFrom)->modify('+15 days');
        $dateFrom = $dateTimeFrom->format("Y-m-d");
        $dateTo = $dateTimeTo->format("Y-m-d");

        $room = Room::pluck('id');

        return [
            'user_id' => User::get()->random()->id,
            'room_id' => $this->faker->unique()->randomElement($room),
            'date_from' => $dateFrom,
            'date_to' => $dateTo
        ];
    }
}
