<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BikeType; // Adjust namespace as per your application

class BikeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BikeType::create(['type' => 'enduro']);
        BikeType::create(['type' => 'sport']);
        BikeType::create(['type' => 'naked']);
    }
}