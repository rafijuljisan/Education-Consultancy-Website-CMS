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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('subject');
        $table->string('country');
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->string('ielts_score')->nullable();
        $table->text('message')->nullable();
        $table->boolean('is_read')->default(false); // To track if admin saw it
        $table->timestamps();

        // Adding indexes for faster searching in Admin Panel
        $table->index('email');
        $table->index('is_read');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
