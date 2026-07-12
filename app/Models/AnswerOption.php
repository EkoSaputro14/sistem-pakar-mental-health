<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['label', 'value', 'sort_order', 'is_active'])]
class AnswerOption extends Model
{
    protected function casts(): array
    {
        return [
            'value' => 'decimal:1',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function active(): \Illuminate\Database\Eloquent\Collection
    {
        return static::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('value')
            ->get();
    }
}
