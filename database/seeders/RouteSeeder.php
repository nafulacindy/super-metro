<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    protected $placeNames = [
        'Nairobi',
        'Kikuyu',
        'Thika',
        'Limuru',
        'Ruiru',
        // Add more place names as needed
    ];

    public function run()
    {
        // Get all the buses from the buses table
        $buses = Bus::all();

        // Loop through each bus and create a route
        foreach ($buses as $bus) {
            Route::create([
                'bus_id' => $bus->bus_id,
                'start_location' => $this->getRandomPlace(),
                'end_location' => $this->getRandomPlace(),
                'distance' => 100, // Replace this with the actual distance
                'duration' => 120, // Replace this with the actual duration
                'fare' => 50.00, // Replace this with the actual fare
            ]);
        }
    }

    protected function getRandomPlace()
    {
        return $this->placeNames[array_rand($this->placeNames)];
    }
}
