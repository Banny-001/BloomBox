<?php

namespace Database\Seeders;
use App\Models\Item;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item= new Item;
            $item->itemNumber='1';
            $item->itemName="Teddy";
           $item-> itemAmount= '1000 ';
           $item-> itemDescription=' white teddybear';
            $item->itemImagePath="/public/images/arm chair.jpg";
          
           $item-> itemPopular=' popular';
           $item-> itemRating=' 5';
           
           $item->save();
    }
}
