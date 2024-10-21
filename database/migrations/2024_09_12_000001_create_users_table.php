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
        /* tinyInteger: 1 byte, max range: 255 (unsigned).
        smallInteger: 2 bytes, max range: 65,535 (unsigned).
        mediumInteger: 3 bytes, max range: 16,777,215 (unsigned).
        integer: 4 bytes, max range: 4,294,967,295 (unsigned).
        bigInteger: 8 bytes, max range: 18,446,744,073,709,551,615 (unsigned). */

        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 64)->unique();
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->date('birthday');
            $table->enum('user_status', ['active', 'inactive', 'banned'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            /* foreign id */
            $table->foreignId('country_id')->constrained('countries', 'country_id');
            $table->foreignId('role_id')->default(2)->constrained('roles', 'role_id'); //user role assigned by default 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
