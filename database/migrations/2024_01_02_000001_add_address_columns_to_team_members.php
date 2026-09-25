<?php
// database/migrations/2024_01_02_000001_add_address_columns_to_team_members.php
// Run: php artisan migrate

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            // Full office address strings (for the bottom strip on the PDF card)
            $table->string('region1_address', 300)->nullable()->after('region1_website');
            $table->string('region2_address', 300)->nullable()->after('region2_website');

            // Per-region email for the office footer  (e.g. info@knrint.in)
            $table->string('region1_office_email')->nullable()->after('region1_address');
            $table->string('region2_office_email')->nullable()->after('region2_address');

            // Company tagline (e.g. "Knowledge Network Research")
            $table->string('company_tagline', 200)->nullable()->after('company_website');
        });
    }
 
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn([
                'region1_address', 'region2_address',
                'region1_office_email', 'region2_office_email',
                'company_tagline',
            ]);
        });
    }
};