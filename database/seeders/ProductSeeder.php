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
        Product::query()->delete();

        Product::create([
            'name' => 'Gold Coffee',
            'markup' => 0.25
        ]);

        Product::create([
            'name' => 'Arabic Coffee',
            'markup' => 0.15
        ]);
    }
}
