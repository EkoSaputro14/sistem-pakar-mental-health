<?php

namespace App\Repositories\Eloquent;

use App\Models\Depression;
use App\Repositories\Contracts\DepressionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DepressionRepository implements DepressionRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Depression::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('code')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function allActive(): Collection
    {
        return Depression::query()
            ->where('is_active', true)
            ->orderBy('code')
            ->get();
    }

    public function find(int $id): ?Depression
    {
        return Depression::find($id);
    }

    public function findByCode(string $code): ?Depression
    {
        return Depression::where('code', $code)->first();
    }

    public function create(array $data): Depression
    {
        return Depression::create($data);
    }

    public function update(Depression $depression, array $data): Depression
    {
        $depression->update($data);

        return $depression;
    }

    public function delete(Depression $depression): void
    {
        $depression->delete();
    }
}
