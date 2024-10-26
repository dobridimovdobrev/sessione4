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
        Schema::create('season_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained('seasons', 'season_id')->onDelete('cascade');
            $table->foreignId('image_file_id')->constrained('image_files', 'image_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_image');
    }
};
