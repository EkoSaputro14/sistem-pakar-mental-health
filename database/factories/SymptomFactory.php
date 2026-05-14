<?php

namespace Database\Factories;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Symptom>
 */
class SymptomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'A'.str_pad((string) fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'name' => fake()->sentence(3),
            'question' => fake()->sentence(8).'?',
            'base_cf' => fake()->randomFloat(2, 0, 1),
            'is_active' => true,
        ];
    }
}
