<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use App\Models\DiagnosisDetail;
use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DiagnosisDetail>
 */
class DiagnosisDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diagnosis_id' => Diagnosis::factory(),
            'symptom_id' => Symptom::factory(),
            'user_answer' => fake()->randomElement(['Tidak Pernah', 'Kadang-kadang', 'Sering', 'Selalu']),
            'user_cf' => fake()->randomElement([0.0, 0.3, 0.6, 1.0]),
            'expert_cf' => fake()->randomFloat(2, 0, 1),
            'cf_he' => fake()->randomFloat(4, 0, 1),
        ];
    }
}
