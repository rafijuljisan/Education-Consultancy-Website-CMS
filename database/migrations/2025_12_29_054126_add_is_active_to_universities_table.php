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
        Schema::table('universities', function (Blueprint $table) {
            // Add is_active column after slug
            $table->boolean('is_active')->default(true)->after('slug');
            
            // Optional: Add index for better performance
            $table->index('is_active');
        });
        
        // Set all existing universities to active
        DB::table('universities')->update(['is_active' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            // Remove index first (if it exists)
            $table->dropIndex(['is_active']);
            
            // Remove column
            $table->dropColumn('is_active');
        });
    }
};