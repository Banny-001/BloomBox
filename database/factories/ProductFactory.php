<?php

namespace Database\Factories;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        return [
            'florist_id' => Florist::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'flowers', true),
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 500),
            'description' => $this->faker->sentence,
            'popular_id' => null, 
            'category_id' => null, 
            'special_occassion_id' => null,
        ];
    }
}
