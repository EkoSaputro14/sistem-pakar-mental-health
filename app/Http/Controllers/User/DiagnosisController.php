<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubmitDiagnosisRequest;
use App\Models\AnswerOption;
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

        $answerOptions = AnswerOption::active()->map(fn ($opt) => [
            'label' => $opt->label,
            'value' => (float) $opt->value,
        ])->all();

        return view('user.diagnosis', compact('symptoms', 'answerOptions'));
    }

    public function store(SubmitDiagnosisRequest $request)
    {
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

        $answerLabels = AnswerOption::active()
            ->mapWithKeys(fn ($opt) => [rtrim(rtrim((string) (float) $opt->value, '0'), '.') => $opt->label])
            ->all();

        $user = $request->user();

        /** @var Diagnosis $diagnosis */
        $diagnosis = DB::transaction(function () use ($user, $bestDepression, $bestCf, $result, $symptoms, $answers, $ruleExpertBySymptomId, $answerLabels, $request) {
            $diagnosis = Diagnosis::create([
                'user_id' => $user?->id,
                'depression_id' => $bestDepression->id,
                'cf_value' => round($bestCf, 4),
                'cf_breakdown' => $result['breakdown'],
                'tanggal_lahir' => $request->validated('tanggal_lahir'),
                'semester' => $request->validated('semester'),
                'tahun_angkatan' => $request->validated('tahun_angkatan'),
                'prodi' => $request->validated('prodi'),
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
