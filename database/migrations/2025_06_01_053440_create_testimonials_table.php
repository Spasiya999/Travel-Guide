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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('message');
            $table->string('country');
            $table->string('date');
            $table->integer('rating');
            $table->string('image')->nullable();
            $table->string('user_image')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->integer('service_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
