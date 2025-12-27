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
    Schema::table('language_courses', function (Blueprint $table) {
        $table->date('start_date')->nullable(); // For "Next Batch"
        $table->boolean('certificate_available')->default(true); // For "Certificate Included" badge
    });
}

public function down(): void
{
    Schema::table('language_courses', function (Blueprint $table) {
        $table->dropColumn(['start_date', 'certificate_available']);
    });
}
};
