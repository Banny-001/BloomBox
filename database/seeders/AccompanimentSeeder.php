<?php

namespace Database\Seeders;

use App\Models\Accompaniment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccompanimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accompaniment=new Accompaniment;
        $accompaniment->accompanimentName='Teddybear';
        $accompaniment->accompanimentPopular='popular';
        $accompaniment->accompanimentImagepath='/public/images/rose.jpg';
        $accompaniment->accompanimentDescription='Brown teddy bear';
        $accompaniment->accompanimentRating='5';
        $accompaniment->accompanimentAmount='200';
        $accompaniment->save();
    }
}
