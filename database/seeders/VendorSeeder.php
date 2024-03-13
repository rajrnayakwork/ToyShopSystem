<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Kolkata Product'],
            ['name' => 'China Product'],
            ['name' => 'Delhi Product'],
            ['name' => 'Mumbai Product'],
            ['name' => 'Japan Product'],
        ];
        Vendor::insert($rows);
    }
}
