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
        'breakfast_calories',
        'lunch_calories',
        'dinner_calories',
        'snacks_calories',
        'carbs_g',
        'protein_g',
        'fat_g',
        'breakfast_carbs_g',
        'lunch_carbs_g',
        'dinner_carbs_g',
        'snacks_carbs_g',
        'breakfast_protein_g',
        'lunch_protein_g',
        'dinner_protein_g',
        'snacks_protein_g',
        'breakfast_fat_g',
        'lunch_fat_g',
        'dinner_fat_g',
        'snacks_fat_g',
        'intake_notes',
    ];

    protected function casts(): array
    {
        return [
            'logged_on' => 'date',
            'weight_kg' => 'decimal:2',
            'did_walk' => 'boolean',
            'walk_km' => 'decimal:2',
            'breakfast_calories' => 'integer',
            'lunch_calories' => 'integer',
            'dinner_calories' => 'integer',
            'snacks_calories' => 'integer',
            'carbs_g' => 'decimal:2',
            'protein_g' => 'decimal:2',
            'fat_g' => 'decimal:2',
            'breakfast_carbs_g' => 'decimal:2',
            'lunch_carbs_g' => 'decimal:2',
            'dinner_carbs_g' => 'decimal:2',
            'snacks_carbs_g' => 'decimal:2',
            'breakfast_protein_g' => 'decimal:2',
            'lunch_protein_g' => 'decimal:2',
            'dinner_protein_g' => 'decimal:2',
            'snacks_protein_g' => 'decimal:2',
            'breakfast_fat_g' => 'decimal:2',
            'lunch_fat_g' => 'decimal:2',
            'dinner_fat_g' => 'decimal:2',
            'snacks_fat_g' => 'decimal:2',
        ];
    }
}

