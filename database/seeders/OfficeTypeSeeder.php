<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $officeTypes = [
            [
                'type_name' => 'Head Office',
            ],
            [
                'type_name' => 'Branch Office',
            ],
        ];
        DB::table('office_types')->insert($officeTypes);
    }
}
