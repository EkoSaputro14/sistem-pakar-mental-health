<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DiagnosisRepositoryInterface;

class HistoryController extends Controller
{
    public function __construct(private readonly DiagnosisRepositoryInterface $diagnoses) {}

    public function index()
    {
        $items = $this->diagnoses->paginateForUser(request()->user()->id);

        return view('user.history', compact('items'));
    }
}
