<?php

namespace App\Repositories\Eloquent;

use App\Models\Recommendation;
use App\Repositories\Contracts\RecommendationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RecommendationRepository implements RecommendationRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Recommendation::query()
            ->with('depression')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('depression', fn ($q) => $q->where('code', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%"));
            })
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data): Recommendation
    {
        return Recommendation::create($data);
    }

    public function update(Recommendation $recommendation, array $data): Recommendation
    {
        $recommendation->update($data);

        return $recommendation;
    }

    public function delete(Recommendation $recommendation): void
    {
        $recommendation->delete();
    }
}
