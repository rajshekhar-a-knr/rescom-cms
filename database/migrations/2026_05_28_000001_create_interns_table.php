<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained('team_departments')->nullOnDelete();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('certificate')->nullable();
            $table->string('certificate_token')->nullable();
            $table->json('skills')->nullable();
            $table->integer('experience_years')->nullable()->default(0);
            $table->string('intern_type')->default('current');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interns');
    }
};
