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
    Schema::create('affiliates', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('logo'); // Path to image
        $table->string('url')->nullable(); // Optional link to university site
        $table->integer('sort_order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();

        // Adding index as per your guidelines
        $table->index(['is_active', 'sort_order']); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
