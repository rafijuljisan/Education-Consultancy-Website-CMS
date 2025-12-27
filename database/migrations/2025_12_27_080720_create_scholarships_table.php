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
    Schema::create('scholarships', function (Blueprint $table) {
        $table->id();
        // Basic Info
        $table->string('title'); // e.g. "Russian Government Scholarship 2025"
        $table->string('slug')->unique();
        $table->foreignId('country_id')->constrained()->cascadeOnDelete(); // Link to your existing Countries
        $table->string('university')->nullable(); // Optional: Specific Uni or "All Universities"
        $table->string('degree_level'); // e.g. "Bachelor, Master, PhD"
        $table->string('funding_type'); // e.g. "Fully Funded", "Partial Funding"
        $table->date('deadline')->nullable();
        $table->string('image')->nullable();

        // Rich Content
        $table->longText('description')->nullable(); // Overview
        
        // Dynamic Lists (JSON)
        $table->json('benefits')->nullable();       // Financial coverage details
        $table->json('requirements')->nullable();   // Eligibility criteria
        $table->json('documents')->nullable();      // Required docs checklist
        $table->json('application_process')->nullable(); // Step-by-step guide
        $table->json('timeline')->nullable();       // Key dates (Open, Close, Result)
        $table->json('faqs')->nullable();           // Common questions

        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
