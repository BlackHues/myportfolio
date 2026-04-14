<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table): void {
            $table->string('full_url', 2048)->nullable()->after('path');
            $table->string('query_string', 2048)->nullable()->after('full_url');
            $table->string('device_type', 20)->nullable()->after('user_agent');
            $table->string('device_model', 120)->nullable()->after('device_type');
            $table->string('browser', 80)->nullable()->after('device_model');
            $table->string('os', 80)->nullable()->after('browser');
            $table->boolean('is_bot')->default(false)->after('os');
            $table->string('utm_source', 255)->nullable()->after('referer');
            $table->string('utm_medium', 255)->nullable()->after('utm_source');
            $table->string('utm_campaign', 255)->nullable()->after('utm_medium');
            $table->string('utm_term', 255)->nullable()->after('utm_campaign');
            $table->string('utm_content', 255)->nullable()->after('utm_term');
            $table->string('country', 120)->nullable()->after('utm_content');
            $table->string('region', 120)->nullable()->after('country');
            $table->string('city', 120)->nullable()->after('region');
        });
    }

    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table): void {
            $table->dropColumn([
                'full_url',
                'query_string',
                'device_type',
                'device_model',
                'browser',
                'os',
                'is_bot',
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_term',
                'utm_content',
                'country',
                'region',
                'city',
            ]);
        });
    }
};
