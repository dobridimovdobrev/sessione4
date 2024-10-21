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
        Schema::create('trailers', function (Blueprint $table) {
            $table->id('trailer_id');
            $table->string('url');
            $table->unsignedBigInteger('content_id');   // id (Movies, Tvseries, Seasons, Episodes)
            $table->string('content_type');   // type (Movies, Tvseries, Seasons, Episodes)
            $table->timestamps();
            $table->softDeletes();
             
            //Composite index for faster queries
            $table->index(['content_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trailers');
    }
};
