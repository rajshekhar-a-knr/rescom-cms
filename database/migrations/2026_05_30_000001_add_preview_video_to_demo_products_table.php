<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demo_products', function (Blueprint $table) {
            $table->string('preview_video')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('demo_products', function (Blueprint $table) {
            $table->dropColumn('preview_video');
        });
    }
};
