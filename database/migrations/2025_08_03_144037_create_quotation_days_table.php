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
        Schema::create('quotation_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->integer('day_number');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('accommodation')->nullable();
            $table->json('meals_included')->nullable(); // ['breakfast', 'lunch', 'dinner']
            $table->json('activities')->nullable();
            $table->string('transport')->nullable();
            $table->decimal('cost_per_person', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_days');
    }
};
