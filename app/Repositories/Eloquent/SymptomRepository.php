<?php

namespace App\Repositories\Eloquent;

use App\Models\Symptom;
use App\Repositories\Contracts\SymptomRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SymptomRepository implements SymptomRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Symptom::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('question', 'like', "%{$search}%");
                });
            })
            ->orderBy('code')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function allActive(): Collection
    {
        return Symptom::query()
            ->where('is_active', true)
            ->orderBy('code')
            ->get();
    }

    public function find(int $id): ?Symptom
    {
        return Symptom::find($id);
    }

    public function create(array $data): Symptom
    {
        return Symptom::create($data);
    }

    public function update(Symptom $symptom, array $data): Symptom
    {
        $symptom->update($data);

        return $symptom;
    }

    public function delete(Symptom $symptom): void
    {
        $symptom->delete();
    }
}
