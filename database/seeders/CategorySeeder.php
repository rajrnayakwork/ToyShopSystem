<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Car','vendor_id' => 1],
            ['name' => 'Clothes','vendor_id' => 2],
            ['name' => 'Craft','vendor_id' => 3],
            ['name' => 'Bike','vendor_id' => 4],
            ['name' => 'Phone','vendor_id' => 5],
        ];
        Category::insert($rows);
    }
}
