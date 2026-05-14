<?php

namespace App\Repositories\Contracts;

use App\Models\Symptom;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SymptomRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function allActive(): Collection;

    public function find(int $id): ?Symptom;

    public function create(array $data): Symptom;

    public function update(Symptom $symptom, array $data): Symptom;

    public function delete(Symptom $symptom): void;
}
