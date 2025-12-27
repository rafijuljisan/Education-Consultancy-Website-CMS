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
    Schema::table('language_courses', function (Blueprint $table) {
        $table->json('benefits')->nullable();           // "Why Learn..." section
        $table->json('variants')->nullable();           // "Short-term" vs "Mid-term" options
        $table->json('features')->nullable();           // "Our Commitment" points
        $table->json('course_testimonials')->nullable();// "Student Success Stories"
        $table->json('faqs')->nullable();               // "Frequently Asked Questions"
    });
}

public function down(): void
{
    Schema::table('language_courses', function (Blueprint $table) {
        $table->dropColumn(['benefits', 'variants', 'features', 'course_testimonials', 'faqs']);
    });
}
};
