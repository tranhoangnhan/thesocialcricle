<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_username' => 'john_doe',
            'user_fullname' => 'John Doe',
            'user_password' => Hash::make('password123'),
            'user_email' => 'john@example.com',
            'user_role' => (string) 1, // You can set the role ID accordingly
            'user_avatar' => 'path/to/avatar.jpg',
            
        ]);
    }
}
