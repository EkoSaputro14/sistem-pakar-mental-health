<?php

namespace Database\Factories;

use App\Models\Depression;
use App\Models\Diagnosis;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Diagnosis>
 */
class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'depression_id' => Depression::factory(),
            'cf_value' => fake()->randomFloat(4, 0, 1),
            'cf_breakdown' => null,
        ];
    }
}
