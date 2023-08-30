<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;




class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add your schedule data here
        $schedules = [
            [
                'route_id' => 3, // Replace with the route_id of your desired route
                'bus_id' => 2,   // Replace with the bus_id of your desired bus
                'departure_time' => '08:00',
                'arrival_time' => '08:30',
                'schedule_date' => now()->addDays(1)->format('Y-m-d'),
            ],
            // Add more schedules as needed
        ];

       
            // Add more schedules as needed
    

        // Loop through the array and insert data into the schedules table
        foreach ($schedules as $scheduleData) {
            Schedule::create($scheduleData);
        }
    }


}
