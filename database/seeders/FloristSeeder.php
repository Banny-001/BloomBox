<?php

namespace Database\Seeders;

use App\Models\Florist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $florist=new Florist;
        $florist->floristTitle='Mary';
        $florist->floristImagePath='/public/images/shop.png';
        $florist->floristLocation='Tom Mboya';
        $florist->save();

    }
}
