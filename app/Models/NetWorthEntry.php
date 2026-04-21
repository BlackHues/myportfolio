<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetWorthEntry extends Model
{
    protected $fillable = [
        'year',
        'assets',
        'liabilities',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'assets' => 'decimal:2',
            'liabilities' => 'decimal:2',
        ];
    }
}
