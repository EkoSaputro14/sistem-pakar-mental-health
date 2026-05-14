<?php

namespace App\Repositories\Contracts;

use App\Models\Rule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RuleRepositoryInterface
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator;

    public function byDepression(int $depressionId): Collection;

    public function create(array $data): Rule;

    public function update(Rule $rule, array $data): Rule;

    public function delete(Rule $rule): void;
}
