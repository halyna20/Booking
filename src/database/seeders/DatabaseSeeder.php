<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            UserSeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            TypeSeeder::class,
            ApartmentSeeder::class,
            RoomSeeder::class,
            OfferSeeder::class,
            //ImageSeeder::class
        ]);
    }
}
