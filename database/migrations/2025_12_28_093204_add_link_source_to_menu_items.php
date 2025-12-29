<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            // Stores which type was selected (e.g., 'custom', 'page', 'country')
            $table->string('link_source')->nullable()->default('custom');
            
            // Stores the specific selections if they aren't custom
            $table->string('page_route')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['link_source', 'page_route', 'country_id', 'service_id']);
        });
    }
};