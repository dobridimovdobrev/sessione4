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
        Schema::create('tv_series_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tv_series_id')->constrained('tv_series', 'tv_series_id')->onDelete('cascade');
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade');
            $table->string('role')->default('actor');  // Aggiunto role per specificare il ruolo (actor, director, etc)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series_person');
    }
};
