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
    Schema::create('language_courses', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // e.g., "IELTS Academic"
        $table->string('slug')->unique();
        $table->string('thumbnail')->nullable();
        $table->text('short_description')->nullable(); // For the card view
        $table->longText('content')->nullable(); // Full syllabus/details
        
        // key Details
        $table->string('duration')->nullable(); // e.g., "8 Weeks"
        $table->string('batch_type')->nullable(); // e.g., "Weekend / Weekday"
        $table->string('mode')->default('Online & Offline'); // e.g., "Online"
        $table->decimal('fee', 10, 2)->nullable();
        
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_courses');
    }
};
