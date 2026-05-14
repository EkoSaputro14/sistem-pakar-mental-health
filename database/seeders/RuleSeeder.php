<?php

namespace Database\Seeders;

use App\Models\Depression;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $mild = ['A001', 'A002', 'A003', 'A004'];
            $moderate = ['A005', 'A006', 'A007', 'A008'];
            $severe = ['A009', 'A010', 'A011', 'A012'];

            $map = [
                'D1' => $mild,
                'D2' => $moderate,
                'D3' => $severe,
            ];

            foreach ($map as $depressionCode => $symptomCodes) {
                $depression = Depression::where('code', $depressionCode)->firstOrFail();

                foreach ($symptomCodes as $symptomCode) {
                    $symptom = Symptom::where('code', $symptomCode)->firstOrFail();

                    Rule::updateOrCreate(
                        ['depression_id' => $depression->id, 'symptom_id' => $symptom->id],
                        ['expert_cf' => $symptom->base_cf]
                    );
                }
            }
        });
    }
}
