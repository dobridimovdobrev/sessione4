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
        Schema::create('episode_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained('episodes', 'episode_id')->onDelete('cascade');
            $table->foreignId('image_file_id')->constrained('image_files', 'image_id')->onDelete('cascade');
            $table->enum('type', ['still'])->default('still');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode_image');
    }
};
