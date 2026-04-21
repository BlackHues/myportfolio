<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();
            $table->date('logged_on')->unique();
            $table->decimal('weight_kg', 5, 2);
            $table->boolean('did_walk')->default(false);
            $table->decimal('walk_km', 5, 2)->nullable();
            $table->unsignedInteger('calories_intake')->nullable();
            $table->decimal('carbs_g', 6, 2)->nullable();
            $table->decimal('protein_g', 6, 2)->nullable();
            $table->decimal('fat_g', 6, 2)->nullable();
            $table->text('intake_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weight_logs');
    }
};

