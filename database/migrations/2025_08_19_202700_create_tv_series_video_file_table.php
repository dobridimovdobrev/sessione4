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
        Schema::create('tv_series_video_file', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tv_series_id')->constrained('tv_series', 'tv_series_id')->onDelete('cascade');
            $table->foreignId('video_file_id')->constrained('video_files', 'video_file_id')->onDelete('cascade');
            $table->timestamps();
            
            // Prevent duplicate associations
            $table->unique(['tv_series_id', 'video_file_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series_video_file');
    }
};
