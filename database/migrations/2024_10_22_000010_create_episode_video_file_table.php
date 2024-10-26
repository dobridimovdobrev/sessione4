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
        Schema::create('episode_video_file', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained('episodes', 'episode_id')->onDelete('cascade');
            $table->foreignId('video_file_id')->constrained('video_files', 'video_file_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode_video_file');
    }
};