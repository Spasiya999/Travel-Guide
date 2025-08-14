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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['car', 'van', 'minibus', 'bus', 'coach', 'luxury_car', 'suv']);
            $table->integer('capacity');
            $table->text('description');
            $table->json('features')->nullable(); // ['wifi', 'ac', 'gps', 'entertainment_system']
            $table->decimal('cost_per_day', 8, 2);
            $table->decimal('cost_per_km', 6, 2)->default(0);
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric'])->default('petrol');
            $table->boolean('ac_available')->default(true);
            $table->boolean('driver_included')->default(true);
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
