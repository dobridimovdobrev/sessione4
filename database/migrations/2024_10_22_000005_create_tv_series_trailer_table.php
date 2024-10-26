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
        Schema::create('tv_series_trailer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tv_series_id')->constrained('tv_series', 'tv_series_id')->onDelete('cascade');
            $table->foreignId('trailer_id')->constrained('trailers', 'trailer_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series_trailer');
    }
};
