<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mines = [];

        for ($i = 1; $i <= 6; $i++) {
            $mines[] = [
                'mine_name' => 'Mine ' . $i,
            ];
        }

        DB::table('mines')->insert($mines);
    }
}
