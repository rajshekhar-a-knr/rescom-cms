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
            $table->index('country');
            $table->index('state');
            $table->index('city');
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            $table->dropIndex(['country']);
            $table->dropIndex(['state']);
            $table->dropIndex(['city']);
            $table->dropIndex(['ip']);
        });
    }
};
