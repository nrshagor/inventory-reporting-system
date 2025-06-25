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
        $products = [
            ['name' => 'Rice 1kg', 'purchase_price' => 50, 'sell_price' => 70, 'stock' => 100],
            ['name' => 'Sugar 1kg', 'purchase_price' => 60, 'sell_price' => 85, 'stock' => 80],
            ['name' => 'Oil 1L', 'purchase_price' => 120, 'sell_price' => 150, 'stock' => 60],
            ['name' => 'Salt 1kg', 'purchase_price' => 15, 'sell_price' => 25, 'stock' => 200],
            ['name' => 'Bread Pack', 'purchase_price' => 30, 'sell_price' => 45, 'stock' => 70],
            ['name' => 'Milk 1L', 'purchase_price' => 55, 'sell_price' => 80, 'stock' => 90],
            ['name' => 'Eggs (12 pcs)', 'purchase_price' => 110, 'sell_price' => 140, 'stock' => 50],
            ['name' => 'Flour 2kg', 'purchase_price' => 70, 'sell_price' => 100, 'stock' => 120],
            ['name' => 'Potatoes 1kg', 'purchase_price' => 20, 'sell_price' => 30, 'stock' => 150],
            ['name' => 'Onions 1kg', 'purchase_price' => 25, 'sell_price' => 40, 'stock' => 130],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
