<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'role_id' => '1',
                'permission_id' => '1',
            ],
        ];
        RolePermission::insert($rows);
    }
}
