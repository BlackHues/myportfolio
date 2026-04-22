<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 150);
            $table->enum('status', ['incomplete', 'completed', 'dropped'])->default('incomplete');
            $table->boolean('is_pinned')->default(false);
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('created_at_ms');
            $table->unsignedInteger('order_index')->default(0);
            $table->timestamps();

            $table->index(['user_id', 'order_index']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_todos');
    }
};

