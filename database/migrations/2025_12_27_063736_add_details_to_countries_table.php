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
        Schema::table('countries', function (Blueprint $table) {
            // "Why Study Here" Section (Array of title/desc)
            $table->json('why_study')->nullable();

            // "At a Glance" Stats (Array of key/value pairs)
            $table->json('quick_stats')->nullable();

            // "Living Costs" Section (Array of item/cost)
            $table->json('living_costs')->nullable();

            // "Application Requirements" (List of documents)
            $table->json('requirements')->nullable();

            // Standard Text Areas
            $table->longText('visa_info')->nullable();      // "How to Apply"
            $table->longText('work_permit_info')->nullable(); // "Work While Studying"
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(['why_study', 'quick_stats', 'living_costs', 'requirements', 'visa_info', 'work_permit_info']);
        });
    }
};
