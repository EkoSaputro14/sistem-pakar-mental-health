<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depression;
use App\Models\Diagnosis;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Diagnosis::query()->count();
        $totalDiagnoses = Diagnosis::query()->count();
        $depressions = Depression::query()->orderBy('code')->get();

        $counts = $depressions->mapWithKeys(function ($d) {
            $count = Diagnosis::query()->where('depression_id', $d->id)->count();

            return [$d->code => $count];
        });

        return view('admin.dashboard', compact('totalMahasiswa', 'totalDiagnoses', 'depressions', 'counts'));
    }
}
