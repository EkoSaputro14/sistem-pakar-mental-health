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
        $totalUsers = User::query()->where('role', 'user')->count();
        $totalDiagnoses = Diagnosis::query()->count();
        $depressions = Depression::query()->orderBy('code')->get();

        $counts = $depressions->mapWithKeys(function ($d) {
            $count = Diagnosis::query()->where('depression_id', $d->id)->count();

            return [$d->code => $count];
        });

        return view('admin.dashboard', compact('totalUsers', 'totalDiagnoses', 'depressions', 'counts'));
    }
}
