<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin_routine_items', function (Blueprint $table) {
            $table->string('end_time', 5)->default('10:00')->after('scheduled_time');
        });

        DB::table('admin_routine_items')->orderBy('id')->chunkById(100, function ($rows): void {
            foreach ($rows as $row) {
                $start = substr((string) $row->scheduled_time, 0, 5);
                $end = date('H:i', strtotime($start . ' +1 hour'));

                DB::table('admin_routine_items')
                    ->where('id', $row->id)
                    ->update(['end_time' => $end]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('admin_routine_items', function (Blueprint $table) {
            $table->dropColumn('end_time');
        });
    }
};
