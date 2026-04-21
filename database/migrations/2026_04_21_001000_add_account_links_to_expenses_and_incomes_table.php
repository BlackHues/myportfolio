<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('payment_channel', 20)->default('cash')->after('notes');
            $table->foreignId('debit_card_id')->nullable()->after('payment_channel')->constrained('debit_cards')->nullOnDelete();
            $table->foreignId('credit_card_id')->nullable()->after('debit_card_id')->constrained('credit_cards')->nullOnDelete();
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->string('payment_channel', 20)->default('cash')->after('notes');
            $table->foreignId('debit_card_id')->nullable()->after('payment_channel')->constrained('debit_cards')->nullOnDelete();
            $table->foreignId('credit_card_id')->nullable()->after('debit_card_id')->constrained('credit_cards')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('credit_card_id');
            $table->dropConstrainedForeignId('debit_card_id');
            $table->dropColumn('payment_channel');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('credit_card_id');
            $table->dropConstrainedForeignId('debit_card_id');
            $table->dropColumn('payment_channel');
        });
    }
};

