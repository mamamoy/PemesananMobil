<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $vehicles = [];

        for ($i = 1; $i <= 100; $i++) {
            $vehicles[] = [
                'plate_number' => $faker->lexify('??') . ' ' . $faker->randomNumber(4, true) . ' ' . $faker->lexify('??'),
                'vehicle_name' => 'VHC-' . $faker->word,
                'fuel_consume' => $faker->numberBetween(5, 30),
                'repair' => $faker->numberBetween(0, 1),
                'usage_history' => $faker->numberBetween(1,25),
                'rental_status' =>$faker->boolean(),
            ];
        }

        DB::table('vehicles')->insert($vehicles);
    }
}
