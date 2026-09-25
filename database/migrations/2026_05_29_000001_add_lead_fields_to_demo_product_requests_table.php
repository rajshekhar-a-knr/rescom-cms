<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demo_product_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('demo_product_requests', 'full_name')) {
                $table->string('full_name')->nullable()->after('demo_product_id');
            }

            if (! Schema::hasColumn('demo_product_requests', 'phone')) {
                $table->string('phone', 40)->nullable()->after('email');
            }

            if (! Schema::hasColumn('demo_product_requests', 'organization')) {
                $table->string('organization')->nullable()->after('phone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('demo_product_requests', function (Blueprint $table) {
            foreach (['organization', 'phone', 'full_name'] as $column) {
                if (Schema::hasColumn('demo_product_requests', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
