<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'user_name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 1,
            ],
            [
                'user_name' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2,
            ],
            [
                'user_name' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 3,
            ],
        ];
        User::insert($rows);
    }
}
