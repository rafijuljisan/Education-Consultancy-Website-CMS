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
            // Add structured columns for better layouts
            $table->json('visa_steps')->nullable(); // For the Timeline view

            // We will repurpose 'requirements' column to be JSON array instead of RichText string.
            // If you have existing data, you might need to clear it or migrate it manually.
            // This migration just adds the new specific column.
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('visa_steps');
        });
    }
};
