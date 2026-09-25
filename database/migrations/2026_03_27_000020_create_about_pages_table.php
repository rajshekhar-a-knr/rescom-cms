<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_badge')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_highlight')->nullable();
            $table->text('hero_subtitle')->nullable();

            $table->string('story_badge')->nullable();
            $table->string('story_title')->nullable();
            $table->string('story_highlight')->nullable();
            $table->text('story_body_1')->nullable();
            $table->text('story_body_2')->nullable();

            $table->string('vision_title')->nullable();
            $table->text('vision_body')->nullable();
            $table->string('mission_title')->nullable();
            $table->text('mission_body')->nullable();

            $table->string('values_title')->nullable();
            $table->json('values')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
