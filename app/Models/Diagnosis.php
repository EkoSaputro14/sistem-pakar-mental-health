<?php

namespace App\Models;

use Database\Factories\DiagnosisFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'depression_id', 'cf_value', 'cf_breakdown', 'tanggal_lahir', 'semester', 'tahun_angkatan', 'prodi'])]
class Diagnosis extends Model
{
    /** @use HasFactory<DiagnosisFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cf_value' => 'decimal:4',
            'cf_breakdown' => 'array',
            'tanggal_lahir' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depression()
    {
        return $this->belongsTo(Depression::class);
    }

    public function details()
    {
        return $this->hasMany(DiagnosisDetail::class);
    }

    public function getUmurAttribute(): ?int
    {
        if (! $this->tanggal_lahir) {
            return null;
        }

        return $this->tanggal_lahir->age;
    }

    public function getIdentitasAttribute(): string
    {
        $parts = array_filter([
            $this->prodi,
            $this->semester ? "Sem {$this->semester}" : null,
            $this->tahun_angkatan,
            $this->umur ? "{$this->umur} tahun" : null,
        ]);

        return implode(' · ', $parts) ?: '-';
    }
}
