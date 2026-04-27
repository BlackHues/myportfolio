<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->unsignedInteger('breakfast_calories')->nullable()->after('calories_intake');
            $table->unsignedInteger('lunch_calories')->nullable()->after('breakfast_calories');
            $table->unsignedInteger('dinner_calories')->nullable()->after('lunch_calories');
            $table->unsignedInteger('snacks_calories')->nullable()->after('dinner_calories');

            $table->decimal('breakfast_carbs_g', 6, 2)->nullable()->after('snacks_calories');
            $table->decimal('lunch_carbs_g', 6, 2)->nullable()->after('breakfast_carbs_g');
            $table->decimal('dinner_carbs_g', 6, 2)->nullable()->after('lunch_carbs_g');
            $table->decimal('snacks_carbs_g', 6, 2)->nullable()->after('dinner_carbs_g');

            $table->decimal('breakfast_protein_g', 6, 2)->nullable()->after('snacks_carbs_g');
            $table->decimal('lunch_protein_g', 6, 2)->nullable()->after('breakfast_protein_g');
            $table->decimal('dinner_protein_g', 6, 2)->nullable()->after('lunch_protein_g');
            $table->decimal('snacks_protein_g', 6, 2)->nullable()->after('dinner_protein_g');

            $table->decimal('breakfast_fat_g', 6, 2)->nullable()->after('snacks_protein_g');
            $table->decimal('lunch_fat_g', 6, 2)->nullable()->after('breakfast_fat_g');
            $table->decimal('dinner_fat_g', 6, 2)->nullable()->after('lunch_fat_g');
            $table->decimal('snacks_fat_g', 6, 2)->nullable()->after('dinner_fat_g');
        });
    }

    public function down(): void
    {
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->dropColumn([
                'breakfast_calories',
                'lunch_calories',
                'dinner_calories',
                'snacks_calories',
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
            ]);
        });
    }
};

