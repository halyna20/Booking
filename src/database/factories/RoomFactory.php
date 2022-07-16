<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::get()->random()->id,
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(),
            'image' => json_encode(['link' => [$this->faker->imageUrl, $this->faker->imageUrl]]),
            'number_of_adults' => $this->faker->numberBetween(1, 30),
            'number_of_children' => $this->faker->numberBetween(0, 10),
            'price' => $this->faker->numberBetween(1000, 10000),
            'size' => $this->faker->numberBetween(10, 2000),
        ];
    }
}
