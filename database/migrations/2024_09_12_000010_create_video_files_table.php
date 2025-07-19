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
            $table->string('title', 128)->index();
            $table->string('url');
            $table->string('format');  //  mp4, mkv, avi, youtube
            $table->string('resolution')->nullable();  //  1080p, 720p
            $table->bigInteger('size')->default(0);  // dimensione in bytes
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
