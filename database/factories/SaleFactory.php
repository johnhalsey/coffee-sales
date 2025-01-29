<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'product_name' => 'Gold Coffee',
            'quantity' => $this->faker->randomDigit(),
            'unit_cost' => $this->faker->randomFloat(2, 1, 100),
            'selling_cost' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
