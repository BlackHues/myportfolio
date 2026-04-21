<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'name',
        'total_limit',
        'used_amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_limit' => 'decimal:2',
            'used_amount' => 'decimal:2',
        ];
    }
}
