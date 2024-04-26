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
            $table->text('property_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_details', function (Blueprint $table) {
            // Drop the 'property_location' column if it exists
            $table->dropColumn('property_location');
        });
    }
};
