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
        Schema::create('movie_person', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('movie_id')->constrained('movies', 'movie_id')->onDelete('cascade'); // Foreign key to movies
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade'); // Foreign key to persons (actors)
            $table->string('role')->default('actor');  // Aggiunto role per specificare il ruolo (actor, director, etc)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_person');
    }
};
