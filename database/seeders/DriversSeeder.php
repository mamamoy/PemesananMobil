<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $drivers = [];

        for ($i = 1; $i <= 80; $i++) {
            $drivers[] = [
                'driver_name' => $faker->name,
            ];
        }

        DB::table('drivers')->insert($drivers);
    }
}
