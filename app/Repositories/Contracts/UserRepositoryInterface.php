<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function paginate(?string $search = null, ?string $role = null, int $perPage = 10): LengthAwarePaginator;

    public function update(User $user, array $data): User;
}
