<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BikeBrand;

class BikeBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed two bike brands
        $brands = [
            ['name' => 'Brand A', 'countryName' => 'Country A'],
            ['name' => 'Brand B', 'countryName' => 'Country B'],
        ];

        foreach ($brands as $brand) {
            BikeBrand::create($brand);
        }
    }
}
