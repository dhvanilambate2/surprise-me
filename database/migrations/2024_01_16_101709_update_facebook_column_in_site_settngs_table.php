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
        Schema::table('site_settngs', function (Blueprint $table) {
            $table->string('facebook')->nullable()->change();
            $table->string('skype')->nullable()->change();
            $table->string('twitter')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settngs', function (Blueprint $table) {
            //
        });
    }
};
