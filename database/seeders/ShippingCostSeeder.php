<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingCost;

class ShippingCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['province' => 'DKI Jakarta', 'city' => 'Jakarta Selatan', 'cost' => 10000],
            ['province' => 'DKI Jakarta', 'city' => 'Jakarta Barat', 'cost' => 10000],
            ['province' => 'Jawa Barat', 'city' => 'Bandung', 'cost' => 15000],
            ['province' => 'Jawa Barat', 'city' => 'Bekasi', 'cost' => 12000],
            ['province' => 'Jawa Tengah', 'city' => 'Semarang', 'cost' => 18000],
            ['province' => 'Jawa Timur', 'city' => 'Surabaya', 'cost' => 20000],
            ['province' => 'Yogyakarta', 'city' => 'Yogyakarta', 'cost' => 17000],
            ['province' => 'Bali', 'city' => 'Denpasar', 'cost' => 25000],
        ];

        foreach ($data as $row) {
            ShippingCost::create($row);
        }
    }
}
