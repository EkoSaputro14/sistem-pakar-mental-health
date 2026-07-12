<?php

namespace Database\Seeders;

use App\Models\AnswerOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerOptionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $options = [
            ['label' => 'Tidak Pernah', 'value' => 0.0, 'sort_order' => 1],
            ['label' => 'Kadang-kadang', 'value' => 0.3, 'sort_order' => 2],
            ['label' => 'Sering', 'value' => 0.6, 'sort_order' => 3],
            ['label' => 'Selalu', 'value' => 1.0, 'sort_order' => 4],
        ];

        foreach ($options as $option) {
            AnswerOption::updateOrCreate(
                ['value' => $option['value']],
                $option,
            );
        }
    }
}
