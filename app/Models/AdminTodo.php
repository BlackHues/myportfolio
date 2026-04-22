<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTodo extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'status',
        'is_pinned',
        'due_date',
        'created_at_ms',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'is_pinned' => 'boolean',
            'due_date' => 'date',
            'created_at_ms' => 'integer',
            'order_index' => 'integer',
        ];
    }
}

