<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            if (!Schema::hasColumn('page_visits', 'country')) {
                $table->string('country', 100)->nullable()->after('device_type');
            }
            if (!Schema::hasColumn('page_visits', 'state')) {
                $table->string('state', 100)->nullable()->after('country');
            }
            if (!Schema::hasColumn('page_visits', 'city')) {
                $table->string('city', 100)->nullable()->after('state');
            }
            if (!Schema::hasColumn('page_visits', 'district')) {
                $table->string('district', 100)->nullable()->after('city');
            }
            if (!Schema::hasColumn('page_visits', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('district');
            }
            if (!Schema::hasColumn('page_visits', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            $table->dropColumn(['country', 'state', 'city', 'district', 'latitude', 'longitude']);
        });
    }
};
