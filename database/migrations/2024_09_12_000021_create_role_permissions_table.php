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
        //This is a pivot table to connect roles with permissions
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->primary(['role_id', 'permission_id']);  // Composite primary key
            $table->foreignId('role_id')->constrained('roles', 'role_id');
            $table->foreignId('permission_id')->constrained('permissions', 'permission_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
