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
    Schema::create('countries', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // e.g., "United Kingdom"
        $table->string('slug')->unique();
        $table->string('flag_image')->nullable();
        $table->string('cover_image')->nullable(); // Hero image for the country page
        $table->text('short_description')->nullable(); // "Why study in UK?"
        $table->longText('details')->nullable(); // Full guide (Visa rules, cost of living)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
