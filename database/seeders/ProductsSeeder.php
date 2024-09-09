<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product=new Product;
        $product->productName='Rose';
        $product->productAmount='200';
        $product->productImagepath='https://i.pinimg.com/564x/0f/f5/e7/0ff5e752272fb33b39bc3db535171624.jpg';
        $product->productPopular='popular';
        $product->productDescription='Red Rose';
        $product->productRating='5';
        $product->productSeller='Mary';
        $product->save();




    }
}
