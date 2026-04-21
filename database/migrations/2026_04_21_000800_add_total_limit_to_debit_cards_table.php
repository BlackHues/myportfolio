<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('debit_cards', function (Blueprint $table) {
            $table->decimal('total_limit', 12, 2)->default(0)->after('bank_name');
        });
    }

    public function down(): void
    {
        Schema::table('debit_cards', function (Blueprint $table) {
            $table->dropColumn('total_limit');
        });
    }
};
