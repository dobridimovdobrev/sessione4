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
        Schema::create('image_files', function (Blueprint $table) {
            $table->id('image_id');
            $table->string('url');  // Path relativo dell'immagine da TMDB
            $table->string('title')->nullable()->index();  //  title for the image
            $table->text('description')->nullable();  //  description for accessibility/SEO
            $table->enum('type', ['poster', 'backdrop', 'still', 'persons'])->index(); // Tipo di immagine
            $table->string('size_path')->default('original'); // w500, original, etc.
            $table->string('base_path')->default('https://image.tmdb.org/t/p/'); // Base URL TMDB
            $table->string('format')->default('jpg');  // jpg, png, webp
            $table->unsignedBigInteger('size')->nullable();  //  size in bytes
            $table->unsignedInteger('width')->nullable();  // larghezza in pixel
            $table->unsignedInteger('height')->nullable();  // altezza in pixel
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_files');
    }
};
