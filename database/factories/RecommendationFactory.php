<?php

namespace Database\Factories;

use App\Models\Depression;
use App\Models\Recommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recommendation>
 */
class RecommendationFactory extends Factory
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
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(3),
            'is_active' => true,
        ];
    }
}
