<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl(),
            'apartment_id' => Apartment::get()->random()->id,
            'room_id' => $this->faker->boolean() ? Room::get()->random()->id : null
        ];
    }
}
