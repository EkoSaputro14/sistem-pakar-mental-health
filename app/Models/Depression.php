<?php

namespace App\Models;

use Database\Factories\DepressionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['code', 'name', 'description', 'is_active'])]
class Depression extends Model
{
    /** @use HasFactory<DepressionFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
