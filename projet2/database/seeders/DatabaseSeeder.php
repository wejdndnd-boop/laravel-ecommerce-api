<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Khala2 Admin (krmal t-jarrib CRUD el Products)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'), // Better than bcrypt() in latest Laravel
            'role' => 'admin',
        ]);

        // 2. Khala2 Normal User (krmal t-jarrib el Orders)
        User::factory()->create([
            'name' => 'Normal Customer',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 3. Khala2 50 Products (metel ma talabet)
        // Note: T'akkad enno 3andak ProductFactory jahze!
        Product::factory(50)->create();
    }
}