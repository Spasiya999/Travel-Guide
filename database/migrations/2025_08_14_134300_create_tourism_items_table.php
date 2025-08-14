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
        // Create tourism_items table for national parks, sites, activities
        Schema::create('tourism_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['national_park', 'heritage_site', 'activity']);
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price_usd', 10, 2)->default(0);
            $table->decimal('price_lkr', 10, 2)->default(0);
            $table->json('features')->nullable(); // Store additional features/requirements
            $table->boolean('requires_transport')->default(false);
            $table->string('duration')->nullable(); // e.g., "2 hours", "Full day"
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index(['type', 'status']);
        });

        // Create quotation_tourism_items pivot table
        Schema::create('quotation_tourism_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained()->onDelete('cascade');
            $table->foreignId('tourism_item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->json('custom_details')->nullable(); // Store any custom modifications
            $table->boolean('is_optional')->default(false);
            $table->timestamps();

            $table->unique(['quotation_id', 'tourism_item_id']);
        });

        // Add tourism_items_total to quotations table
        Schema::table('quotations', function (Blueprint $table) {
            $table->decimal('tourism_items_total', 10, 2)->default(0)->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn('tourism_items_total');
        });

        Schema::dropIfExists('quotation_tourism_items');
        Schema::dropIfExists('tourism_items');
    }
};
