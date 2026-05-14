<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Repositories\Contracts\DiagnosisRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosisResultController extends Controller
{
    public function __construct(private readonly DiagnosisRepositoryInterface $diagnoses) {}

    public function show(Diagnosis $diagnosis)
    {
        $item = $this->diagnoses->findForUser($diagnosis->id, request()->user()->id);
        abort_if(! $item, 404);

        $confidencePercent = round(((float) $item->cf_value) * 100, 2);
        $recommendations = $item->depression?->recommendations()->where('is_active', true)->get() ?? collect();

        return view('user.result', [
            'diagnosis' => $item,
            'confidencePercent' => $confidencePercent,
            'recommendations' => $recommendations,
        ]);
    }

    public function pdf(Diagnosis $diagnosis)
    {
        $item = $this->diagnoses->findForUser($diagnosis->id, request()->user()->id);
        abort_if(! $item, 404);

        $confidencePercent = round(((float) $item->cf_value) * 100, 2);
        $recommendations = $item->depression?->recommendations()->where('is_active', true)->get() ?? collect();

        $pdf = Pdf::loadView('pdf.diagnosis', [
            'diagnosis' => $item,
            'confidencePercent' => $confidencePercent,
            'recommendations' => $recommendations,
        ])->setPaper('a4');

        return $pdf->download('hasil-diagnosis-'.$item->id.'.pdf');
    }
}
