<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        return [
            'name' => fake()->firstName($gender) . ' ' . fake()->lastName($gender) . ', S.H., M.Kn.',
            'area' => fake()->city(),
            'address' => fake()->address(),
            'active' => fake()->randomElement([true, false]),
            'notes' => fake()->sentence(15),
        ];
    }
}
