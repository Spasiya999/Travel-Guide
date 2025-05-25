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
        // Create projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('client');
            $table->string('technology')->nullable();
            $table->date('start_date');
            $table->date('expected_completion');
            $table->integer('total_duration_weeks')->nullable();
            $table->enum('status', ['planning', 'in_progress', 'completed', 'cancelled'])->default('planning');
            $table->timestamps();
        });

        // Create project_phases table
        Schema::create('project_phases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('phase_number');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'pending'])->default('not_started');
            $table->timestamps();
        });

        // Create project_tasks table
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_phase_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'pending', 'overdue'])->default('not_started');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->text('deliverables')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
        Schema::dropIfExists('project_phases');
        Schema::dropIfExists('projects');
    }
};
