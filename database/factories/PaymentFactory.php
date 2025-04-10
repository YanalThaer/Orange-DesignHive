<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'amount' => fake()->randomFloat(2, 5, 500), 
            'payment_method' => fake()->randomElement(['visa', 'mastercard', 'paypal']),
            'status' => fake()->randomElement(['pending', 'completed', 'failed']),
            'transaction_id' => fake()->uuid(),
            

        ];
    }
}
