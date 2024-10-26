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
        Schema::create('video_files', function (Blueprint $table) {
            $table->id('video_file_id');
            $table->string('url');
            $table->string('format');  //  mp4, mkv, avi
            $table->unsignedBigInteger('size');  // File size in bytes
            $table->string('resolution')->nullable();  //  1080p, 720p
            $table->time('duration')->nullable();  // Duration
            $table->timestamps();
            $table->softDeletes();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_files');
    }
};
