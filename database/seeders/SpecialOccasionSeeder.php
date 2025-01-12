<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpecialOccassion;

class SpecialOccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialOccasions = [
            'Mother\'s Day',
            'Birthday',
            'Valentine\'s Day',
            'Christmas',
            'Anniversary',
            'Father\'s Day',
            'Easter',
            'New Year\'s Eve',
            'Thanksgiving',
            'Graduation',
        ];
        foreach ($specialOccasions as $occasion) {
            SpecialOccassion::create([
                'name' => $occasion,
            ]);
        }
    }
}
