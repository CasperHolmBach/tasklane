<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained('projects') // Peger på 'projects' tabellen
                  ->onDelete('cascade');

            $table->foreignId('assigned_user_id')
                  ->nullable() // En opgave behøver ikke altid at være tildelt
                  ->constrained('users') // Peger på 'users' tabellen
                  ->onDelete('set null'); // Sæt til NULL, hvis brugeren slettes

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('To Do');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};