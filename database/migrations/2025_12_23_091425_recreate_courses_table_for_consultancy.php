<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Drop the old table if it exists
        Schema::dropIfExists('courses');

        // 2. Create the new Consultancy-style table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Relationships
            // A course belongs to a University (e.g., Greenwich University)
            $table->foreignId('university_id')->constrained()->cascadeOnDelete();

            // Optional: You can keep 'category_id' if you want to group by "Engineering", "Business", etc.
            // If you deleted the categories table, remove this line.
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            // Basic Info
            $table->string('title'); // e.g., "MSc Data Science"
            $table->string('slug')->unique();
            $table->string('level'); // e.g., "Undergraduate", "Postgraduate", "PHD"

            // Financials & Duration
            $table->decimal('tuition_fee', 10, 2)->nullable(); // e.g., 15000.00
            $table->string('currency')->default('USD'); // e.g., GBP, USD, EUR
            $table->string('duration'); // e.g., "1 Year", "3 Years"

            // Admissions
            $table->string('intake_months')->nullable(); // e.g., "September, January"
            $table->text('entry_requirements')->nullable(); // e.g., "IELTS 6.5, GPA 3.0"

            // Content
            $table->longText('description')->nullable();
            $table->boolean('is_featured')->default(false);

            $table->timestamps();

            // Indexes
            $table->index('level');
            $table->index('tuition_fee');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};