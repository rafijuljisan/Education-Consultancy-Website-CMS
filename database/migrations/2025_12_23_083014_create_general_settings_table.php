<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();

            // Brand Identity
            $table->string('site_name')->default('StudyLifter Clone');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();

            // Theme Colors (For dynamic theming)
            $table->string('primary_color')->default('#4F46E5'); // Default Indigo
            $table->string('secondary_color')->default('#10B981'); // Default Emerald

            // Hero Section (The big banner on home page)
            $table->string('hero_title')->default('Unlock Your Potential');
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_button_text')->default('Get Started');
            $table->string('hero_button_url')->default('/courses');

            // SEO & Contact
            $table->string('meta_description')->nullable();
            $table->string('contact_email')->nullable();

            $table->timestamps();

            // Adding an index to frequently queried text fields (per your preference)
            $table->index('site_name');
        });

        // Insert the default "Single Row" immediately so the page is never empty
        DB::table('general_settings')->insert([
            'site_name' => 'My Study Platform',
            'hero_description' => 'Learn from the best instructors around the world.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};