<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'developer',
            'email' => 'developer@example.com',
            'password' => Hash::make('Test@Password123#'),
        ]);
    }
}

