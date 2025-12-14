<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 'teams' er pivot-tabellen, der forbinder Users og Projects
        Schema::create('teams', function (Blueprint $table) {
            
            // Fremmednøgle til User
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Fremmednøgle til Project
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');

            // Sæt den sammensatte primære nøgle for at sikre,
            // at et user-project-par kun kan eksistere én gang.
            $table->primary(['user_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};