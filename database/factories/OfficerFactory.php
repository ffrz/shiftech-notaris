<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OfficerFactory extends Factory
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
            'name' => fake()->firstName($gender) . ' ' . fake()->lastName($gender),
            'description' => fake()->sentence(25),
            'active' => fake()->randomElement([true, false]),
        ];
    }
}
