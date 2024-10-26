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
            $table->string('url');  // URL to the image file
            $table->string('title')->nullable();  //  title for the image
            $table->text('description')->nullable();  //  description for accessibility/SEO
            $table->string('format');  // jpg, png, webp
            $table->unsignedBigInteger('size');  //  size in bytes
            $table->unsignedSmallInteger('width')->nullable();  //  width in pixels
            $table->unsignedSmallInteger('height')->nullable();  // height in pixels
        
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
