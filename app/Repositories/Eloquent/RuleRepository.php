<?php

namespace App\Repositories\Eloquent;

use App\Models\Rule;
use App\Repositories\Contracts\RuleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RuleRepository implements RuleRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Rule::query()
            ->with(['depression', 'symptom'])
            ->when($search, function ($query, $search) {
                $query->whereHas('depression', fn ($q) => $q->where('code', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%"))
                    ->orWhereHas('symptom', fn ($q) => $q->where('code', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%"));
            })
            ->orderBy('depression_id')
            ->orderBy('symptom_id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function byDepression(int $depressionId): Collection
    {
        return Rule::query()
            ->with(['symptom'])
            ->where('depression_id', $depressionId)
            ->orderBy('symptom_id')
            ->get();
    }

    public function create(array $data): Rule
    {
        return Rule::create($data);
    }

    public function update(Rule $rule, array $data): Rule
    {
        $rule->update($data);

        return $rule;
    }

    public function delete(Rule $rule): void
    {
        $rule->delete();
    }
}
