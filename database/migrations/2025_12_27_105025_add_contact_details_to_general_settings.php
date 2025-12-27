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
    Schema::table('general_settings', function (Blueprint $table) {
    
        $table->longText('google_map_code')->nullable(); // For the <iframe> code
    });
}

public function down(): void
{
    Schema::table('general_settings', function (Blueprint $table) {
        $table->dropColumn(['google_map_code']);
    });
}
};
