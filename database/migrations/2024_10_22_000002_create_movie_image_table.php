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
        Schema::create('movie_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies', 'movie_id')->onDelete('cascade'); // Foreign key to movies
            $table->foreignId('image_file_id')->constrained('image_files', 'image_id')->onDelete('cascade'); // Foreign key to image files
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_image');
    }
};
