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
         Schema::create('video_details', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();;
            $table->text('description')->nullable();
            $table->string('video_url'); // You may store the video URL or path
            $table->integer('duration_minutes')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_details');
    }
};
