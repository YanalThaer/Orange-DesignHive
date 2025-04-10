<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlans>
 */
class SubscriptionPlansFactory extends Factory
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
            'price' => fake()->randomFloat(2, 5, 500), 
            'duration' => fake()->randomElement(['monthly', 'yearly']), 
            'type' => fake()->randomElement(['user', 'designer', 'designer_featured']),
            'can_contact_designer' => fake()->boolean(),
            'featured_post' => fake()->boolean(),
        ];
    }
}
