<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
{
    // Ra7 nekhla2 50 products mara wa7de
    \App\Models\Product::factory(50)->create();
}
    }
}
