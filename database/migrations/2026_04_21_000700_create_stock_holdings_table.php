<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_holdings', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->nullable();
            $table->string('name');
            $table->decimal('quantity', 12, 4)->default(0);
            $table->decimal('current_value', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_holdings');
    }
};
