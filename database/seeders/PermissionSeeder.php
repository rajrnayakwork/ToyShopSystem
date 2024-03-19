<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'name' => 'admin_dashboard',
                'display_name' => 'Admin Dashboard',
            ],
            [
                'name' => 'view_vendor',
                'display_name' => 'View Vendor',
            ],
            [
                'name' => 'store_vendor',
                'display_name' => 'Store Vendor',
            ],
            [
                'name' => 'edit_vendor',
                'display_name' => 'Edit Vendor',
            ],
            [
                'name' => 'destroy_vendor',
                'display_name' => 'Destroy Vendor',
            ],
        ];
        Permission::insert($rows);
    }
}
