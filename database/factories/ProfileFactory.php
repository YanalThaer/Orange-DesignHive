<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,10),
            'profile_picture' => fake()->imageUrl(640, 480, 'people'),
            'bio' => fake()->sentence(),
            'location' => fake()->city(),
            'facebook' => fake()->url(),
            'twitter' => fake()->url(),
            'linkedin' => fake()->url(),
            'instagram' => fake()->url(),
        ];
    }
}
