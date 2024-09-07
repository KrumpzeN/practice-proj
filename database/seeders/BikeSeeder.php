<?php

namespace Database\Seeders;
use App\Models\Bike;
use App\Models\BikeBrand;
use App\Models\BikeType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 10 bikes
        $brands = BikeBrand::pluck('id');
        $typeIds = BikeType::pluck('id');

        for ($i = 1; $i <= 10; $i++) {
            Bike::create([
                'bike_brand_id' => $brands->random(),
                'price' => rand(1000, 5000),
                'name' => 'Bike ' . $i,
                'availability' => rand(0, 1),
                'article' => 'ART' . $i,
                'bike_type_id' => $typeIds->random(),
            ]);
        }
    }
}
