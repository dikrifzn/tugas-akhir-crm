<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@sundara.com',
            'password' => 'admin123',
            'role' => 'admin',
        ],[
            'name' => 'customer',
                    'email' => 'customer@sundara.com',
                    'password' => 'customer123',
                    'role' => 'customer',
        ]);
            $this->call([
            ShippingCostSeeder::class,
        ]);
    }
}
