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
        Schema::create('histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->unsignedBigInteger('content_id');  // ID of the content (movie, series, or episode)
            $table->string('content_type');  // movies, series, and episodes
            $table->timestamp('start_date');  // When the user started viewing
            $table->timestamp('end_date')->nullable();  // When the user finished viewing (nullable in case they don't finish)
            $table->decimal('progress', 5, 2)->default(0);  // Progress through the content (percentage)
            $table->timestamps();
            $table->softDeletes();
            
            //Foreign key
            $table->foreignId('user_id')->constrained('users', 'user_id');

            //Composite index for faster queries
            $table->index(['content_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
