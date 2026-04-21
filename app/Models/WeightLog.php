<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    protected $fillable = [
        'logged_on',
        'weight_kg',
        'did_walk',
        'walk_km',
        'calories_intake',
        'carbs_g',
        'protein_g',
        'fat_g',
        'intake_notes',
    ];

    protected function casts(): array
    {
        return [
            'logged_on' => 'date',
            'weight_kg' => 'decimal:2',
            'did_walk' => 'boolean',
            'walk_km' => 'decimal:2',
            'carbs_g' => 'decimal:2',
            'protein_g' => 'decimal:2',
            'fat_g' => 'decimal:2',
        ];
    }
}

