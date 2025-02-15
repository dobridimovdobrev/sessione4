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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id('episode_id');
            $table->foreignId('season_id')->constrained('seasons', 'season_id')->onDelete('cascade');
            $table->string('title', 500)->index();
            $table->string('slug', 500)->unique();
            $table->text('description');
            $table->unsignedTinyInteger('episode_number')->index();
            $table->enum('status', ['published', 'draft', 'scheduled', 'coming soon'])->default('published');
            $table->date('air_date')->nullable();
            $table->bigInteger('tmdb_id')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
