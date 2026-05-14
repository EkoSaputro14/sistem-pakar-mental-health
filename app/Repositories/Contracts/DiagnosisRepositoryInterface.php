<?php

namespace App\Repositories\Contracts;

use App\Models\Diagnosis;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DiagnosisRepositoryInterface
{
    public function paginateForUser(int $userId, int $perPage = 10): LengthAwarePaginator;

    public function paginateForAdmin(?string $search = null, ?int $depressionId = null, int $perPage = 10): LengthAwarePaginator;

    public function findForUser(int $id, int $userId): ?Diagnosis;

    public function find(int $id): ?Diagnosis;

    public function create(array $data): Diagnosis;
}
