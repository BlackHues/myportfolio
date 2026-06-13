<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoutineItem extends Model
{
    protected $fillable = [
        'user_id',
        'routine_date',
        'scheduled_time',
        'title',
        'details',
        'is_done',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'routine_date' => 'date',
            'is_done' => 'boolean',
            'order_index' => 'integer',
        ];
    }
}
