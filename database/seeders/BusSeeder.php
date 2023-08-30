<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run()
    {
        Bus::create([
            'registration_number' => 'ABC123',
            'bus_model' => 'Bus Model 1',
            'seating_capacity' => 50,
            'status' => 'Active',
        ]);

        Bus::create([
            'registration_number' => 'XYZ456',
            'bus_model' => 'Bus Model 2',
            'seating_capacity' => 30,
            'status' => 'Inactive',
        ]);
        Bus::create([
            'registration_number' => 'CBD123',
            'bus_model' => 'Bus Model 3',
            'seating_capacity' => 40,
            'status' => 'Active',
        ]);

        Bus::create([
            'registration_number' => 'YZX456',
            'bus_model' => 'Bus Model 4',
            'seating_capacity' => 30,
            'status' => 'Active',
        ]);
     }
}

