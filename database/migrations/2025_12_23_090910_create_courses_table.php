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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        
        // Basic Info
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        
        // Media
        $table->string('thumbnail')->nullable();
        $table->string('video_url')->nullable(); // Intro video (YouTube/Vimeo)
        
        // Relationships (Foreign Keys)
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
        
        // Details
        $table->decimal('price', 8, 2)->default(0.00); // 99.99
        $table->integer('duration_minutes')->default(0);
        
        // Status Flags
        $table->boolean('is_featured')->default(false);
        $table->boolean('is_published')->default(true);
        
        $table->timestamps();

        // Indexes for performance (Searching and Sorting)
        $table->index('price');
        $table->index('is_published');
        $table->index('is_featured');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
