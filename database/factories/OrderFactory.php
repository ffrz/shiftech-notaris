<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $status = fake()->numberBetween(0, 1);
        $date = fake()->randomElement(['2024-06-01', '2024-06-07', '2024-05-27', '2024-05-22', '2024-05-30', '2024-06-03', '2024-06-04', '2024-06-05']);
        $closed_date = Carbon::createFromFormat('Y-m-d', $date);
        $closed_date->addDays(5);
        $total = fake()->numberBetween(1, 100) * 50000;
        $total_paid = fake()->randomElement([0, 0.25, 0.5, 0.75, 1]) * $total;
        return [
            'customer_id' => fake()->numberBetween(1, 50),
            'service_id' => fake()->numberBetween(1, 14),
            'officer_id' => fake()->numberBetween(1, 10),
            'partner_id' => fake()->randomElement([null, 1, 2]),
            'date' => $date,
            'closed_date' => $status > 0 ? $closed_date->format('Y-m-d') : null,
            'description' => fake()->sentence(5),
            'total' => $total,
            'total_paid' => $total_paid,
            'notes' => '',
            'status' => $status,
        ];
    }
}
