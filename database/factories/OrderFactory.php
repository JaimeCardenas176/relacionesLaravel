<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'pickup_date' => fake()->date('Y-m-d'),
            'pickup_time' => fake()->time('H:i:s'),
            'payment_method'=> "tarjeta",
            'user_id' => 1,
        ];
    }
}
