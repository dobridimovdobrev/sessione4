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
        Schema::create('upload_progress', function (Blueprint $table) {
            $table->id();
            $table->string('upload_id')->unique();
            $table->string('file_name');
            $table->bigInteger('file_size');
            $table->bigInteger('uploaded_size')->default(0);
            $table->float('progress_percentage')->default(0);
            $table->enum('status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
            $table->unsignedBigInteger('user_id')->nullable();
            // Rimuoviamo la foreign key constraint per evitare problemi
            // Se necessario, può essere aggiunta manualmente dopo aver verificato la struttura della tabella users
            $table->string('file_type')->nullable();
            $table->string('error_message')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_progress');
    }
};
