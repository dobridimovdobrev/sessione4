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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id('season_id');
            $table->unsignedTinyInteger('season_number');
            $table->unsignedTinyInteger('total_episodes')->nullable();
            $table->unsignedSmallInteger('year')->index();
            $table->date('premiere_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

             // Foreign key for language
             $table->foreignId('tv_series_id')->constrained('tv_series', 'tv_series_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
