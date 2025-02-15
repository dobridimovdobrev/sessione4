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
            $table->foreignId('tv_series_id')->constrained('tv_series', 'tv_series_id')->onDelete('cascade');
            $table->integer('season_number');
            $table->string('name');
            $table->text('overview')->nullable();
            $table->year('year')->nullable();
            $table->integer('total_episodes')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('seasons');
    }
};
