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
        Schema::create('likes', function (Blueprint $table) {
            $table->id('like_id');
            $table->unsignedBigInteger('content_id');  // ID of the liked content (movie, series, or episode)
            $table->string('content_type');  //  movies, series, and episodes
            $table->timestamps();
            $table->softDeletes();

            //Foreign key
            $table->foreignId('user_id')->constrained('users', 'user_id');

            //Composite index for faster queries
            $table->index(['content_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};