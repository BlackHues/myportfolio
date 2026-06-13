<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_daily_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('note_date');
            $table->text('journal')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'note_date']);
        });

        Schema::create('admin_routine_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('routine_date');
            $table->string('scheduled_time', 5)->default('09:00');
            $table->string('end_time', 5)->default('10:00');
            $table->string('title', 200);
            $table->text('details')->nullable();
            $table->boolean('is_done')->default(false);
            $table->unsignedInteger('order_index')->default(0);
            $table->timestamps();

            $table->index(['user_id', 'routine_date', 'order_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_routine_items');
        Schema::dropIfExists('admin_daily_notes');
    }
};
