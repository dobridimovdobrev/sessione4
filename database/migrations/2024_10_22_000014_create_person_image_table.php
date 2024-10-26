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
        Schema::create('person_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade'); // Foreign key to persons
            $table->foreignId('image_file_id')->constrained('image_files', 'image_id')->onDelete('cascade'); // Foreign key to image files
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_image');
    }
};
