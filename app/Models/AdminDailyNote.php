<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminDailyNote extends Model
{
    protected $fillable = [
        'user_id',
        'note_date',
        'journal',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'note_date' => 'date',
        ];
    }
}
