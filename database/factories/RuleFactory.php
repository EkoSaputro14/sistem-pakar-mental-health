<?php

namespace Database\Factories;

use App\Models\Depression;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rule>
 */
class RuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'depression_id' => Depression::factory(),
            'symptom_id' => Symptom::factory(),
            'expert_cf' => fake()->randomFloat(2, 0, 1),
        ];
    }
}
