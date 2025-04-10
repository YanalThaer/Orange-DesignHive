<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => fake()->numberBetween(1,10),
            'receiver_id' => fake()->numberBetween(1,10),
            'message' => fake()->sentence(),
            'is_read' => fake()->boolean(),
            
        ];
    }
}
