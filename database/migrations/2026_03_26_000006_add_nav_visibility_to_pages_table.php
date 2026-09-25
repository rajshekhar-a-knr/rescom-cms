<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'show_in_header')) {
                $table->boolean('show_in_header')->default(false)->after('status');
            }
            if (!Schema::hasColumn('pages', 'show_in_footer')) {
                $table->boolean('show_in_footer')->default(false)->after('show_in_header');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'show_in_footer')) {
                $table->dropColumn('show_in_footer');
            }
            if (Schema::hasColumn('pages', 'show_in_header')) {
                $table->dropColumn('show_in_header');
            }
        });
    }
};
