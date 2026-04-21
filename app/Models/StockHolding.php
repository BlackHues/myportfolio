<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHolding extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'quantity',
        'current_value',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:4',
            'current_value' => 'decimal:2',
        ];
    }
}
