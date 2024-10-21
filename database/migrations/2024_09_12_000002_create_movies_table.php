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
        Schema::create('movies', function (Blueprint $table) {
            $table->id('movie_id');
            $table->string('title', 128)->index();
            $table->string('slug')->unique(); 
            $table->text('description');
            $table->unsignedSmallInteger('year')->index();
            $table->unsignedSmallInteger('duration')->nullable();
            $table->decimal('imdb_rating', 3, 1)->nullable()->index();
            $table->date('premiere_date')->nullable();
            $table->enum('status',['published','draft','scheduled','coming soon'])->default('published');
            $table->timestamps();
            $table->softDeletes();

            //foreign id
            $table->foreignId('category_id')->constrained('categories', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
