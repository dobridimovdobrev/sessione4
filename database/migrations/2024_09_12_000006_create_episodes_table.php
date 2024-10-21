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
            $table->string('title', 64)->index();
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedTinyInteger('episode_number')->index();
            $table->unsignedSmallInteger('duration')->nullable();
            $table->enum('status', ['published', 'draft', 'scheduled', 'coming soon'])->default('published');
            $table->timestamps();
            $table->softDeletes();

            //Foreign id
            $table->foreignId('season_id')->constrained('seasons', 'season_id')->onDelete('cascade');
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
