<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubmitDiagnosisRequest;
use App\Models\Diagnosis;
use App\Repositories\Contracts\SymptomRepositoryInterface;
use App\Services\CertaintyFactorService;
use Illuminate\Support\Facades\DB;

class DiagnosisController extends Controller
{
    public function __construct(
        private readonly SymptomRepositoryInterface $symptoms,
        private readonly CertaintyFactorService $cfService,
    ) {}

    public function create()
    {
        $symptoms = $this->symptoms->allActive();

        $answerOptions = [
            ['label' => 'Tidak Pernah', 'value' => 0.0],
            ['label' => 'Kadang-kadang', 'value' => 0.3],
            ['label' => 'Sering', 'value' => 0.6],
            ['label' => 'Selalu', 'value' => 1.0],
        ];

        return view('user.diagnosis', compact('symptoms', 'answerOptions'));
    }

    public function store(SubmitDiagnosisRequest $request)
    {
        $user = $request->user();

        /** @var array<string, string|float|int> $answers */
        $answers = $request->validated('answers');

        $symptoms = $this->symptoms->allActive();
        foreach ($symptoms as $symptom) {
            if (! array_key_exists((string) $symptom->id, $answers)) {
                return back()->withErrors(['answers' => 'Semua gejala wajib diisi.'])->withInput();
            }
        }

        $userAnswers = [];
        foreach ($answers as $symptomId => $value) {
            $userAnswers[(int) $symptomId] = (float) $value;
        }

        $result = $this->cfService->diagnose($userAnswers);
        $best = $result['best'];

        if (! $best) {
            return back()->withErrors(['answers' => 'Rule diagnosis belum tersedia. Hubungi admin.'])->withInput();
        }

        $bestDepression = $best['depression'];
        $bestCf = (float) $best['cf'];

        $ruleExpertBySymptomId = $bestDepression->rules()
            ->get(['symptom_id', 'expert_cf'])
            ->mapWithKeys(fn ($r) => [$r->symptom_id => (float) $r->expert_cf])
            ->all();

        $answerLabels = [
            '0' => 'Tidak Pernah',
            '0.3' => 'Kadang-kadang',
            '0.6' => 'Sering',
            '1' => 'Selalu',
        ];

        /** @var Diagnosis $diagnosis */
        $diagnosis = DB::transaction(function () use ($user, $bestDepression, $bestCf, $result, $symptoms, $answers, $ruleExpertBySymptomId, $answerLabels) {
            $diagnosis = Diagnosis::create([
                'user_id' => $user->id,
                'depression_id' => $bestDepression->id,
                'cf_value' => round($bestCf, 4),
                'cf_breakdown' => $result['breakdown'],
            ]);

            foreach ($symptoms as $symptom) {
                $userCf = (float) $answers[(string) $symptom->id];
                $key = rtrim(rtrim((string) $userCf, '0'), '.');
                $label = $answerLabels[$key] ?? 'Tidak Pernah';

                $expertCf = (float) ($ruleExpertBySymptomId[$symptom->id] ?? 0);
                $cfHe = $expertCf * $userCf;

                $diagnosis->details()->create([
                    'symptom_id' => $symptom->id,
                    'user_answer' => $label,
                    'user_cf' => $userCf,
                    'expert_cf' => $expertCf,
                    'cf_he' => round($cfHe, 4),
                ]);
            }

            return $diagnosis;
        });

        return redirect()->route('user.result', $diagnosis)->with('success', 'Diagnosis berhasil dihitung.');
    }
}
