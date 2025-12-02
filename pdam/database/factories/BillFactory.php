<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $previousReading = $this->faker->numberBetween(100, 1000);
        $usage = $this->faker->numberBetween(10, 50);
        $currentReading = $previousReading + $usage;
        $rate = 3000; // Simplified rate
        $baseCost = $usage * $rate;
        $adminFee = 2500;
        $totalCost = $baseCost + $adminFee;

        return [
            'user_id' => User::factory(), // Default to creating a new user if not provided
            'billing_month' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'previous_reading' => $previousReading,
            'current_reading' => $currentReading,
            'usage_m3' => $usage,
            'rate_applied' => $rate,
            'base_cost' => $baseCost,
            'admin_fee' => $adminFee,
            'total_cost' => $totalCost,
            'status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']),
            'paid_at' => function (array $attributes) {
                return $attributes['status'] === 'paid' ? now() : null;
            },
        ];
    }
}
