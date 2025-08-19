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
        Schema::table('tv_series', function (Blueprint $table) {
            // Make tmdb_id nullable to allow frontend creation without TMDB ID
            // Don't add unique constraint as it already exists
            $table->bigInteger('tmdb_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tv_series', function (Blueprint $table) {
            // Revert tmdb_id to not nullable (original state)
            // Don't add unique constraint as it already exists
            $table->bigInteger('tmdb_id')->nullable(false)->change();
        });
    }
};
