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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_title')->nullable();
            $table->string('category')->default('General'); // e.g., Education, Health, Environment, Water
            $table->text('description')->nullable(); // Short Summary
            $table->longText('full_description')->nullable(); // Detailed Description
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('location')->nullable();
            $table->string('participants')->nullable(); // e.g. "150 Volunteers"
            $table->integer('progress_percent')->default(0);
            $table->decimal('raised_amount', 12, 2)->default(0.00);
            $table->decimal('goal_amount', 12, 2)->default(0.00);
            $table->string('main_image')->nullable();
            $table->text('gallery_images')->nullable(); // JSON / comma separated
            $table->text('objectives')->nullable();
            $table->text('highlights')->nullable();
            $table->text('quote')->nullable();
            $table->enum('status', ['active', 'completed', 'upcoming'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
