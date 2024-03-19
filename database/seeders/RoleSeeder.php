<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
            ],
        ];
        Role::insert($rows);
    }
}
