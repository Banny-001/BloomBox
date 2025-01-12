<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Roses',
            'Tulips',
            'Lilies',
            'Orchids',
            'Carnations',
            'Sunflowers',
            'Daisies',
        ];
        foreach ($categories as  $categories) {
            Category::create(['name' =>  $categories]);
        }
    }
}
