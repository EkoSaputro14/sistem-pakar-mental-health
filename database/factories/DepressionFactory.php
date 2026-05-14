<?php

namespace Database\Factories;

use App\Models\Depression;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Depression>
 */
class DepressionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'D'.fake()->unique()->numberBetween(1, 9),
            'name' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
