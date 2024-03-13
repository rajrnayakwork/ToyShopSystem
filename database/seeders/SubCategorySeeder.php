<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Tara','category_id' => 1],
            ['name' => 'BMW','category_id' => 1],
            ['name' => 'Suzuki','category_id' => 1],
            ['name' => 'Normal','category_id' => 2],
            ['name' => 'Formal','category_id' => 2],
            ['name' => 'Zenzi','category_id' => 2],
            ['name' => 'Boat','category_id' => 3],
            ['name' => 'Airplane','category_id' => 3],
            ['name' => 'Yamaha','category_id' => 4],
        ];
        SubCategory::insert($rows);
    }
}
