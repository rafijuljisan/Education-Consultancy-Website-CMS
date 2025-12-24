<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Main Heading
            $table->string('subtitle')->nullable(); // Small text above title
            $table->text('description')->nullable(); // Paragraph text
            $table->string('image_path'); // The background image
            $table->string('button_text')->nullable(); // CTA Text
            $table->string('button_link')->nullable(); // CTA URL
            $table->integer('sort_order')->default(0); // To control display order
            $table->boolean('is_active')->default(true); // To hide/show
            $table->timestamps();

            // Adding indexes as requested in your guidelines
            $table->index(['is_active', 'sort_order']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};