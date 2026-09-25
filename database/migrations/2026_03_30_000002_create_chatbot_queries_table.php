<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot_queries', function (Blueprint $table) {
            $table->id();
            $table->text('user_question');
            $table->enum('status', ['pending', 'resolved'])->default('pending')->index();
            $table->text('admin_response')->nullable();
            $table->unsignedBigInteger('resolved_faq_id')->nullable();
            $table->timestamps();

            $table->foreign('resolved_faq_id')->references('id')->on('chatbot_faqs')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_queries');
    }
};
