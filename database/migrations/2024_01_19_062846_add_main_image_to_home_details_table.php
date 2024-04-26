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
        Schema::table('home_details', function (Blueprint $table) {
            // Add image_path column
            $table->string('main_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_details', function (Blueprint $table) {
            // Drop the image_path column if it exists
            $table->dropColumn('main_image');
        });
    }
};
