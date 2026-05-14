<?php

namespace Database\Seeders;

use App\Models\Depression;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepressionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $items = [
                ['code' => 'D1', 'name' => 'Mild Depression', 'description' => 'Gejala depresi ringan yang dapat memengaruhi aktivitas harian namun masih bisa dikelola dengan dukungan dan strategi koping.'],
                ['code' => 'D2', 'name' => 'Moderate Depression', 'description' => 'Gejala depresi sedang dengan dampak yang lebih jelas pada fungsi akademik dan sosial, sering membutuhkan bantuan profesional.'],
                ['code' => 'D3', 'name' => 'Severe Depression', 'description' => 'Gejala depresi berat dengan gangguan signifikan pada fungsi, disarankan segera berkonsultasi ke tenaga kesehatan profesional.'],
            ];

            foreach ($items as $item) {
                Depression::updateOrCreate(
                    ['code' => $item['code']],
                    [...$item, 'is_active' => true]
                );
            }
        });
    }
}
