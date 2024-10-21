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
        Schema::create('content_persons', function (Blueprint $table) {
            $table->id('content_persons_id');
            $table->unsignedBigInteger('content_id');  // ID of movie, series, episode, season
            $table->string('content_type');            // Type: movie, series, episode, season
            $table->timestamps();
            $table->softDeletes();
            
            //Foreign key
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade');

            //Composite index for faster queries
            $table->index(['content_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_persons');
    }
};
