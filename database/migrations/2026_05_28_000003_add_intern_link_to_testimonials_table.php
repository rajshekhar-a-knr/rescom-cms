<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->foreignId('intern_id')->nullable()->after('id')->constrained('interns')->nullOnDelete();
            $table->string('testimonial_source')->default('client')->after('client_company');
        });
    }

    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropConstrainedForeignId('intern_id');
            $table->dropColumn('testimonial_source');
        });
    }
};
