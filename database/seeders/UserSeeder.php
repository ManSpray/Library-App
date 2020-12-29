<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(){
        DB::table('users')->insert([
            'name' => 'Mantelis',
            'email' => 'mantelis@gmail.com',
            'password' => Hash::make('mantelis'),
        ]);
        DB::table('users')->insert([
            'name' => 'A',
            'email' => 'a@b.com',
            'password' => Hash::make('pass'),
        ]);
    }
}
