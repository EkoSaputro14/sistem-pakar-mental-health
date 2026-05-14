<?php

namespace App\Repositories\Contracts;

use App\Models\Recommendation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RecommendationRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Recommendation;

    public function update(Recommendation $recommendation, array $data): Recommendation;

    public function delete(Recommendation $recommendation): void;
}
