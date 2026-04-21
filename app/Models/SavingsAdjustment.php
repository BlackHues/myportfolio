<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsAdjustment extends Model
{
    protected $fillable = [
        'amount',
        'adjusted_on',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'adjusted_on' => 'date',
        ];
    }
}
