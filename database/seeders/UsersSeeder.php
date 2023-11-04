<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role_id' => 1,
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Approval',
                'email' => 'approval@gmail.com',
                'role_id' => 2,
                'password' => Hash::make('approval123'),
            ],
        ];
        DB::table('users')->insert($user);
    }
}
