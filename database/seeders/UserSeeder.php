<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotel.com',
            'role' => 'admin',
            'phone' => '0812345678901',
            'password' => bcrypt('admin123'),
        ]);
        \App\Models\User::create([
            'name' => 'Receptionist',
            'email' => 'reception@hotel.com',
            'role' => 'receptionis',
            'phone' => '0812345678901',
            'password' => bcrypt('reception123'),
        ]);
        \App\Models\User::create([
            'name' => 'Customer',
            'email' => 'customer@hotel.com',
            'role' => 'customer',
            'phone' => '0812345678901',
            'password' => bcrypt('customer123'),
        ]);
    }
}
