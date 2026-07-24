<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_work_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('report_date');
            $table->string('entry_type', 16);
            $table->string('employee_name', 120)->default('Arjun Kumar H');
            $table->json('tasks');
            $table->json('extra_tasks')->nullable();
            $table->text('message_snapshot')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'report_date', 'entry_type']);
            $table->index(['user_id', 'report_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_work_reports');
    }
};
