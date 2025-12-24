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
    Schema::table('menu_items', function (Blueprint $table) {
        // Allows a menu item to belong to another menu item
        $table->foreignId('parent_id')
              ->nullable()
              ->constrained('menu_items')
              ->cascadeOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
        });
    }
};
