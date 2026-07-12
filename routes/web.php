<?php

use App\Http\Controllers\Admin\AnswerOptionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DepressionController;
use App\Http\Controllers\Admin\DiagnosisReportController;
use App\Http\Controllers\Admin\RecommendationController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DiagnosisController as UserDiagnosisController;
use App\Http\Controllers\User\DiagnosisResultController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/tentang-depresi', [HomeController::class, 'about'])->name('user.about');
Route::get('/kontak-darurat', [HomeController::class, 'emergency'])->name('user.emergency');

Route::get('/diagnosis', [UserDiagnosisController::class, 'create'])->name('user.diagnosis');
Route::post('/diagnosis', [UserDiagnosisController::class, 'store'])->name('user.diagnosis.submit');

Route::get('/hasil/{diagnosis}', [DiagnosisResultController::class, 'show'])->name('user.result');
Route::get('/hasil/{diagnosis}/pdf', [DiagnosisResultController::class, 'pdf'])->name('user.result.pdf');

Route::get('/dashboard', function () {
    $user = request()->user();
    if (! $user) {
        return redirect()->route('login');
    }

    return $user->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('symptoms', SymptomController::class);
        Route::resource('depressions', DepressionController::class);
        Route::resource('rules', RuleController::class);
        Route::resource('recommendations', RecommendationController::class);
        Route::resource('answer-options', AnswerOptionController::class)->except(['show']);

        Route::get('/diagnoses', [DiagnosisReportController::class, 'index'])->name('diagnoses.index');
        Route::get('/diagnoses/{diagnosis}/pdf', [DiagnosisReportController::class, 'pdf'])->name('diagnoses.pdf');
        Route::get('/diagnoses/{diagnosis}', [DiagnosisReportController::class, 'show'])->name('diagnoses.show');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    });

require __DIR__.'/auth.php';
