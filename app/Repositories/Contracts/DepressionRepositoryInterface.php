<?php

namespace App\Repositories\Contracts;

use App\Models\Depression;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DepressionRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function allActive(): Collection;

    public function find(int $id): ?Depression;

    public function findByCode(string $code): ?Depression;

    public function create(array $data): Depression;

    public function update(Depression $depression, array $data): Depression;

    public function delete(Depression $depression): void;
}
