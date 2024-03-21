<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'seed1', 'price' => '150', 'quantity' => '6', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '2'],
            ['name' => 'seed2', 'price' => '150', 'quantity' => '1', 'description' => 'bad', 'availability' => '1', 'sub_category_id' => '1'],
            ['name' => 'seed3', 'price' => '150', 'quantity' => '4', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '3'],
            ['name' => 'seed4', 'price' => '150', 'quantity' => '3', 'description' => 'great', 'availability' => '1', 'sub_category_id' => '7'],
            ['name' => 'seed5', 'price' => '150', 'quantity' => '0', 'description' => 'good', 'availability' => '0', 'sub_category_id' => '8'],
            ['name' => 'seed6', 'price' => '150', 'quantity' => '7', 'description' => 'bad', 'availability' => '1', 'sub_category_id' => '9'],
            ['name' => 'seed7', 'price' => '150', 'quantity' => '8', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '4'],
            ['name' => 'seed8', 'price' => '150', 'quantity' => '2', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '5'],
            ['name' => 'seed9', 'price' => '150', 'quantity' => '0', 'description' => 'great', 'availability' => '0', 'sub_category_id' => '6'],
            ['name' => 'seed10', 'price' => '150', 'quantity' => '5', 'description' => 'great', 'availability' => '1', 'sub_category_id' => '7'],
            ['name' => 'seed11', 'price' => '150', 'quantity' => '6', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '8'],
            ['name' => 'seed12', 'price' => '150', 'quantity' => '8', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '9'],
            ['name' => 'seed13', 'price' => '150', 'quantity' => '9', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '1'],
            ['name' => 'seed14', 'price' => '150', 'quantity' => '0', 'description' => 'bad', 'availability' => '0', 'sub_category_id' => '2'],
            ['name' => 'seed15', 'price' => '150', 'quantity' => '1', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '3'],
            ['name' => 'seed16', 'price' => '150', 'quantity' => '6', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '7'],
            ['name' => 'seed17', 'price' => '150', 'quantity' => '2', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '8'],
            ['name' => 'seed18', 'price' => '150', 'quantity' => '3', 'description' => 'great', 'availability' => '1', 'sub_category_id' => '9'],
            ['name' => 'seed19', 'price' => '150', 'quantity' => '6', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '4'],
            ['name' => 'seed20', 'price' => '150', 'quantity' => '0', 'description' => 'good', 'availability' => '0', 'sub_category_id' => '5'],
            ['name' => 'seed21', 'price' => '150', 'quantity' => '1', 'description' => 'bad', 'availability' => '1', 'sub_category_id' => '6'],
            ['name' => 'seed22', 'price' => '150', 'quantity' => '6', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '1'],
            ['name' => 'seed23', 'price' => '150', 'quantity' => '4', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '2'],
            ['name' => 'seed24', 'price' => '150', 'quantity' => '3', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '3'],
            ['name' => 'seed25', 'price' => '150', 'quantity' => '0', 'description' => 'bad', 'availability' => '0', 'sub_category_id' => '4'],
            ['name' => 'seed26', 'price' => '150', 'quantity' => '5', 'description' => 'good', 'availability' => '1', 'sub_category_id' => '5'],
            ['name' => 'seed27', 'price' => '150', 'quantity' => '0', 'description' => 'great', 'availability' => '0', 'sub_category_id' => '6'],
        ];
        Product::insert($rows);
    }
}
