<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            [
                'office_name' => 'Office A',
                'office_type_id'=> 1
            ],
            [
                'office_name' => 'Office B',
                'office_type_id'=> 2
            ],
        ];
        DB::table('offices')->insert($offices);
    }
}
