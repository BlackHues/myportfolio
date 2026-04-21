<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebitCard extends Model
{
    protected $fillable = [
        'name',
        'bank_name',
        'total_limit',
        'current_balance',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_limit' => 'decimal:2',
            'current_balance' => 'decimal:2',
        ];
    }
}
