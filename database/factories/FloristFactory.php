<?php

namespace Database\Factories;
use App\Models\Florist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Florist>
 */
class FloristFactory extends Factory
{
    protected $model = Florist::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'image' => $this->faker->imageUrl(200, 200, 'business', true), 
            'business_name' => $this->faker->company,
            'location' => $this->faker->address,
            'user_id' => User::factory(),
            'phone_number' => $this->faker->phoneNumber,
        ];
    } 
}