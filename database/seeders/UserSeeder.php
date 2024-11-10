<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
               
            ],
           
        ]);

        
        DB::table('users')->insert([
            [
                'name' => 'buyer',
                'email' => 'buyer@gmail.com',
                'password' => Hash::make('buyer123'),
                'role' => 'buyer',
               
            ],
           
        ]);

        
        DB::table('users')->insert([
            [
                'name' => 'seller',
                'email' => 'seller@gmail.com',
                'password' => Hash::make('seller123'),
                'role' => 'seller',
               
            ],
           
        ]);


    }
}
