<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('work_permits', function (Blueprint $table) {
        $table->id();
        $table->string('country');
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('image')->nullable(); // Hero Banner
        
        // Key Details
        $table->string('salary_range')->nullable();
        $table->string('processing_time')->nullable();
        $table->string('visa_type')->nullable();

        // Main Content (Rich Text)
        $table->longText('description')->nullable(); // Intro, Types, Sectors
        $table->longText('requirements')->nullable(); // Documents list
        
        // Dynamic Sections (JSON)
        $table->json('gallery')->nullable(); // "Experience Beauty" images
        $table->json('process_steps')->nullable(); // "How to Apply" steps
        $table->json('faqs')->nullable(); // Frequently Asked Questions
        
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_permits');
    }
};
