<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            // Make content nullable (for layouts like Timeline/Stats that don't use it)
            $table->longText('content')->nullable()->change();
            
            // Make image nullable (for layouts that don't need a main image)
            $table->string('image')->nullable()->change();
            
            // Make subtitle nullable as well, just in case
            $table->string('subtitle')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            // Revert changes if needed (be careful, this might fail if nulls exist)
            // $table->longText('content')->nullable(false)->change();
        });
    }
};