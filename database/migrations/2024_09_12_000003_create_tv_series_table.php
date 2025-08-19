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
        Schema::create('tv_series', function (Blueprint $table) {
            $table->id('tv_series_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->integer('total_episodes')->nullable();
            $table->decimal('imdb_rating', 3, 1)->nullable();
            $table->integer('total_seasons')->default(1);
            $table->enum('status', ['ongoing', 'ended', 'canceled', 'unknown'])->default('unknown');
            $table->foreignId('category_id')->constrained('categories', 'category_id');
            $table->bigInteger('tmdb_id')->nullable()->unique();
            $table->date('premiere_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series');
    }
};
