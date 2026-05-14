<?php

namespace App\Models;

use Database\Factories\DiagnosisFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'depression_id', 'cf_value', 'cf_breakdown'])]
class Diagnosis extends Model
{
    /** @use HasFactory<DiagnosisFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cf_value' => 'decimal:4',
            'cf_breakdown' => 'array',
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
}
