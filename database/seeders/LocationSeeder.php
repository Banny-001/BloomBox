<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Westlands',
            'Kilimani',
            'Kibera',
            'Langata',
            'Ruaraka',
            'Kasarani',
            'Embakasi',
            'Dagoretti',
            'Starehe',
            'Kamukunji',
            'Mathare',
            'Roysambu'
        ];

        foreach ($locations as $location) {
            Location::create(['name' => $location]);
        }
    
    }
}
