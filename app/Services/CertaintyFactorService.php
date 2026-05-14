<?php

namespace App\Services;

use App\Models\Depression;
use App\Models\Rule;
use Illuminate\Support\Collection;

class CertaintyFactorService
{
    /**
     * @param  array<int, float>  $userAnswers  [symptom_id => cf_user]
     * @return array{breakdown: array<string, float>, best: ?array{depression: Depression, cf: float}}
     */
    public function diagnose(array $userAnswers): array
    {
        /** @var Collection<int, Depression> $depressions */
        $depressions = Depression::query()
            ->where('is_active', true)
            ->with(['rules' => fn ($q) => $q->whereHas('symptom', fn ($s) => $s->where('is_active', true))])
            ->orderBy('code')
            ->get();

        $breakdown = [];
        $best = null;

        foreach ($depressions as $depression) {
            $cfCombined = 0.0;

            /** @var Collection<int, Rule> $rules */
            $rules = $depression->rules;

            foreach ($rules as $rule) {
                $userCf = (float) ($userAnswers[$rule->symptom_id] ?? 0);
                $expertCf = (float) $rule->expert_cf;

                $cfHe = $expertCf * $userCf;

                if ($cfHe <= 0) {
                    continue;
                }

                $cfCombined = $this->combine($cfCombined, $cfHe);
            }

            $breakdown[$depression->code] = round($cfCombined, 4);

            if ($best === null || $cfCombined > $best['cf']) {
                $best = ['depression' => $depression, 'cf' => $cfCombined];
            }
        }

        return [
            'breakdown' => $breakdown,
            'best' => $best,
        ];
    }

    public function combine(float $cf1, float $cf2): float
    {
        // CFcombine = CF1 + CF2 * (1 − CF1)
        return $cf1 + $cf2 * (1 - $cf1);
    }
}
