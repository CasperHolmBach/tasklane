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
                  ->constrained('projects')
                  ->onDelete('cascade');

            $table->foreignId('assigned_user_id')
                  ->nullable() 
                  ->constrained('users')
                  ->onDelete('set null');

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['To Do', 'Blocked', 'Doing', 'Testing', 'Done'])
                    ->default('To Do');
            $table->enum('priority', ['Low', 'Medium', 'High', 'Critical'])
                    ->default('Low');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};