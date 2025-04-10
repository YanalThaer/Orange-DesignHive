<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => fake()->name(),
            'image' => fake()->imageUrl(800, 600, 'art', true),
            'format' => fake()->randomElement(['png', 'jpg']),
            'admin_id' => fake()->numberBetween(1,2),

        ];
    }
}
