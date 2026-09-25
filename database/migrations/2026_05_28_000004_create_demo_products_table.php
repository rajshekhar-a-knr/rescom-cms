<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demo_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->json('features')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('login_url')->nullable();
            $table->string('credential_email')->nullable();
            $table->string('credential_username')->nullable();
            $table->text('credential_password')->nullable();
            $table->text('credential_notes')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('demo_product_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demo_product_id')->constrained('demo_products')->cascadeOnDelete();
            $table->string('email');
            $table->string('ip_address')->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        if (Schema::hasTable('permissions')) {
            foreach (['view', 'create', 'edit', 'delete'] as $capability) {
                DB::table('permissions')->updateOrInsert(
                    ['name' => "demo-products.{$capability}"],
                    [
                        'label' => ucfirst($capability) . ' demo products',
                        'group' => 'demo-products',
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }

            $permissionIds = DB::table('permissions')
                ->whereIn('name', [
                    'demo-products.view',
                    'demo-products.create',
                    'demo-products.edit',
                    'demo-products.delete',
                ])
                ->pluck('id');

            if (Schema::hasTable('role_permissions')) {
                foreach (['superadmin', 'admin'] as $role) {
                    foreach ($permissionIds as $permissionId) {
                        DB::table('role_permissions')->updateOrInsert(
                            ['role' => $role, 'permission_id' => $permissionId]
                        );
                    }
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_product_requests');
        Schema::dropIfExists('demo_products');
    }
};
