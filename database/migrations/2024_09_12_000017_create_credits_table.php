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
        Schema::create('credits', function (Blueprint $table) {
            $table->id('credit_id');
            $table->integer('total_credits');  // Total credits the user has acquired
            $table->integer('spent_credits');  // Credits spent on content
            $table->integer('remaining_credits');  // Remaining credits
            $table->timestamp('update_date');  // When the credits were last updated
            $table->timestamps();

            //Foreign key
            $table->foreignId('user_id')->constrained('users', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
