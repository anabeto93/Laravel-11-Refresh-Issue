<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'total' => $this->faker->randomFloat(2, 50, 2000), // Total cost between $50.00 and $2000.00
            'payment_type' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer'])
        ];
    }
}
