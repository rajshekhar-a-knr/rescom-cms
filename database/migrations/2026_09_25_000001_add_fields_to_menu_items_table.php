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
        Schema::table('menu_items', function (Blueprint $table) {
            if (!Schema::hasColumn('menu_items', 'item_type')) {
                $table->string('item_type')->nullable()->default('link')->after('icon');
            }
            if (!Schema::hasColumn('menu_items', 'section')) {
                $table->string('section')->nullable()->default('main')->after('item_type');
            }
            if (!Schema::hasColumn('menu_items', 'badge_text')) {
                $table->string('badge_text')->nullable()->after('section');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'badge_text')) {
                $table->dropColumn('badge_text');
            }
            if (Schema::hasColumn('menu_items', 'section')) {
                $table->dropColumn('section');
            }
            if (Schema::hasColumn('menu_items', 'item_type')) {
                $table->dropColumn('item_type');
            }
        });
    }
};
