<?php

namespace App\Repositories\Eloquent;

use App\Models\Diagnosis;
use App\Repositories\Contracts\DiagnosisRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function paginateForUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Diagnosis::query()
            ->with(['depression'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function paginateForAdmin(?string $search = null, ?int $depressionId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Diagnosis::query()
            ->with(['depression'])
            ->when($depressionId, fn ($q) => $q->where('depression_id', $depressionId))
            ->when($search, function ($query, $search) {
                $query->where('prodi', 'like', "%{$search}%")
                    ->orWhere('tahun_angkatan', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findForUser(int $id, int $userId): ?Diagnosis
    {
        return Diagnosis::query()
            ->with(['depression', 'details.symptom', 'user'])
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function find(int $id): ?Diagnosis
    {
        return Diagnosis::query()
            ->with(['depression', 'details.symptom', 'user'])
            ->find($id);
    }

    public function create(array $data): Diagnosis
    {
        return Diagnosis::create($data);
    }
}
