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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('title')->default('About Lumina Trust');
            $table->string('subtitle')->nullable()->default('Dedicated Non-Profit Organization');
            $table->longText('story')->nullable();
            $table->string('hero_button_text')->nullable()->default('Our Initiatives');
            $table->string('hero_button_link')->nullable()->default('/projects');
            $table->string('secondary_button_text')->nullable()->default('Support Our Cause');
            $table->string('secondary_button_link')->nullable()->default('/donate');
            
            // Who We Are Section
            $table->string('who_we_are_title')->nullable()->default('Uplifting Underserved Communities with Dignity');
            $table->longText('who_we_are_description')->nullable();
            $table->string('image_badge_text')->nullable()->default('100% Non-Profit NGO');
            $table->json('core_values')->nullable();

            // Mission & Vision
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('established_year')->nullable()->default('2018');

            // Impact Metrics
            $table->string('beneficiaries_count')->nullable()->default('10,000+');
            $table->string('projects_count')->nullable()->default('150+');
            $table->string('volunteers_count')->nullable()->default('500+');
            $table->string('cities_count')->nullable()->default('25+');

            // Founder & Leadership
            $table->string('founder_name')->nullable();
            $table->string('founder_title')->nullable();
            $table->text('founder_message')->nullable();

            // Images
            $table->string('main_image')->nullable();
            $table->string('founder_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
