<?php

namespace App\Models;

use Database\Factories\DiagnosisDetailFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['diagnosis_id', 'symptom_id', 'user_answer', 'user_cf', 'expert_cf', 'cf_he'])]
class DiagnosisDetail extends Model
{
    /** @use HasFactory<DiagnosisDetailFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'user_cf' => 'decimal:2',
            'expert_cf' => 'decimal:2',
            'cf_he' => 'decimal:4',
        ];
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
