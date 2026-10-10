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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('General');
            $table->enum('status', ['active', 'completed', 'upcoming'])->default('active');
            $table->decimal('target_amount', 12, 2)->default(0.00);
            $table->decimal('raised_amount', 12, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('area_of_interest')->nullable();
            $table->enum('status', ['pending', 'approved', 'active'])->default('pending');
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->decimal('amount', 12, 2);
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('payment_method')->default('UPI');
            $table->enum('payment_status', ['completed', 'pending', 'failed'])->default('completed');
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type')->default('info'); // e.g., donation, volunteer, project, message
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('volunteers');
        Schema::dropIfExists('projects');
    }
};
