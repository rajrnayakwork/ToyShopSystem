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
                'category' => 'admin',
            ],
            [
                'name' => 'manager_dashboard',
                'display_name' => 'Manager Dashboard',
                'category' => 'manager',
            ],
            [
                'name' => 'customer_dashboard',
                'display_name' => 'Customer Dashboard',
                'category' => 'customer',
            ],
            [
                'name' => 'view_vendor',
                'display_name' => 'View Vendor',
                'category' => 'vendor',
            ],
            [
                'name' => 'store_vendor',
                'display_name' => 'Store Vendor',
                'category' => 'vendor',
            ],
            [
                'name' => 'edit_vendor',
                'display_name' => 'Edit Vendor',
                'category' => 'vendor',
            ],
            [
                'name' => 'destroy_vendor',
                'display_name' => 'Destroy Vendor',
                'category' => 'vendor',
            ],
            [
                'name' => 'view_product',
                'display_name' => 'View Product',
                'category' => 'product',
            ],
            [
                'name' => 'store_product',
                'display_name' => 'Store Product',
                'category' => 'product',
            ],
            [
                'name' => 'edit_product',
                'display_name' => 'Edit Product',
                'category' => 'product',
            ],
            [
                'name' => 'destroy_product',
                'display_name' => 'Destroy Product',
                'category' => 'product',
            ],
        ];
        Permission::insert($rows);
    }
}
