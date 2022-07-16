<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'address' => $this->faker->address,
            'description' => $this->faker->text,
            'image' => json_encode(['link' => [$this->faker->imageUrl, $this->faker->imageUrl]]),
            'city_id' => City::get()->random()->id,
            'type_id' => Type::get()->random()->id,
        ];
    }
}
