<?php

namespace App\Models;

use Database\Factories\SymptomFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['code', 'name', 'question', 'base_cf', 'is_active'])]
class Symptom extends Model
{
    /** @use HasFactory<SymptomFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'base_cf' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function diagnosisDetails()
    {
        return $this->hasMany(DiagnosisDetail::class);
    }
}
