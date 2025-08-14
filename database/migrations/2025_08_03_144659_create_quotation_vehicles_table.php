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
        Schema::create('quotation_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->json('days_assigned'); // array of day numbers [1, 2, 3]
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->integer('estimated_km')->default(0);
            $table->boolean('driver_required')->default(true);
            $table->text('special_requirements')->nullable();
            $table->decimal('cost_per_day', 8, 2);
            $table->decimal('total_cost', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_vehicles');
    }
};
