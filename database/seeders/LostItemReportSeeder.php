<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LostItemReport;

class LostItemReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        LostItemReport::create('lost_item_reports')->insert([
                'bus_registration' => 'cbd1231',
                'travel_date' => '2024-01-12', // Correct date format (YYYY-MM-DD)
                'luggage_description' => 'black bag',
                
            ]);
        }
    }

