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
    Schema::table('about_sections', function (Blueprint $table) {
        // This JSON column will store structured data for Timelines, Stats, FAQs, etc.
        $table->json('data')->nullable(); 
        
        // Add a background color option for variety
        $table->string('bg_color')->default('white'); // white, gray, blue
    });
}

public function down(): void
{
    Schema::table('about_sections', function (Blueprint $table) {
        $table->dropColumn(['data', 'bg_color']);
    });
}
};
