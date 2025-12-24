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
    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('career_id')->constrained('careers')->cascadeOnDelete();
        $table->string('name');
        $table->string('email');
        $table->string('phone')->nullable();
        $table->string('resume_path'); // Stores file path
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
