<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_balances', function (Blueprint $table) {
            $table->id();
            $table->decimal('current_balance', 15, 2)->default(0);
            $table->timestamps();
        });

        $cashIn = (float) DB::table('incomes')->where('payment_channel', 'cash')->sum('amount');
        $cashOut = (float) DB::table('expenses')->where('payment_channel', 'cash')->sum('amount');

        DB::table('cash_balances')->insert([
            'current_balance' => $cashIn - $cashOut,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_balances');
    }
};
