<?php

namespace App\Models;

use Database\Factories\RuleFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['depression_id', 'symptom_id', 'expert_cf'])]
class Rule extends Model
{
    /** @use HasFactory<RuleFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'expert_cf' => 'decimal:2',
        ];
    }

    public function depression()
    {
        return $this->belongsTo(Depression::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
