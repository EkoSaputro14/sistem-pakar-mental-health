<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depression;
use App\Models\Diagnosis;
use App\Repositories\Contracts\DiagnosisRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosisReportController extends Controller
{
    public function __construct(private readonly DiagnosisRepositoryInterface $diagnoses) {}

    public function index()
    {
        $depressions = Depression::query()->orderBy('code')->get();
        $items = $this->diagnoses->paginateForAdmin(request('search'), request('depression_id'));

        return view('admin.diagnoses.index', compact('items', 'depressions'));
    }

    public function show(Diagnosis $diagnosis)
    {
        $item = $this->diagnoses->find($diagnosis->id);
        abort_if(! $item, 404);

        $confidencePercent = round(((float) $item->cf_value) * 100, 2);
        $recommendations = $item->depression?->recommendations()->where('is_active', true)->get() ?? collect();

        return view('admin.diagnoses.show', [
            'diagnosis' => $item,
            'confidencePercent' => $confidencePercent,
            'recommendations' => $recommendations,
        ]);
    }

    public function pdf(Diagnosis $diagnosis)
    {
        $item = $this->diagnoses->find($diagnosis->id);
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
