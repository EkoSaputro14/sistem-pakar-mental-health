<?php

namespace App\Providers;

use App\Repositories\Contracts\DepressionRepositoryInterface;
use App\Repositories\Contracts\DiagnosisRepositoryInterface;
use App\Repositories\Contracts\RecommendationRepositoryInterface;
use App\Repositories\Contracts\RuleRepositoryInterface;
use App\Repositories\Contracts\SymptomRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\DepressionRepository;
use App\Repositories\Eloquent\DiagnosisRepository;
use App\Repositories\Eloquent\RecommendationRepository;
use App\Repositories\Eloquent\RuleRepository;
use App\Repositories\Eloquent\SymptomRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

//test
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SymptomRepositoryInterface::class, SymptomRepository::class);
        $this->app->bind(DepressionRepositoryInterface::class, DepressionRepository::class);
        $this->app->bind(RuleRepositoryInterface::class, RuleRepository::class);
        $this->app->bind(RecommendationRepositoryInterface::class, RecommendationRepository::class);
        $this->app->bind(DiagnosisRepositoryInterface::class, DiagnosisRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }
    public function boot(): void
{
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
}
