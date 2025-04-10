<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(800, 600, 'art', true),
            // 'format' => fake()->randomElement(['png', 'jpg']),
            // 'likes_count' => fake()->numberBetween(0, 100),
            // 'comments_count' => fake()->numberBetween(0, 100),
            'user_id' => fake()->numberBetween(1,10),
            'category_id' => fake()->numberBetween(1,10),
        ];
    }
}
