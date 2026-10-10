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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('hero_badge_text')->nullable();
            $table->string('hero_title_line1')->nullable();
            $table->string('hero_title_line2')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_button_donate_text')->nullable();
            $table->string('hero_button_volunteer_text')->nullable();
            $table->string('hero_card_title')->nullable();
            $table->string('hero_card_subtitle')->nullable();
            $table->string('hero_stat_completed')->nullable();
            $table->string('hero_trust_badge_1')->nullable();
            $table->string('hero_trust_badge_2')->nullable();

            // Impact Counters (Numbers That Speak)
            $table->string('impact_subtitle')->nullable();
            $table->string('impact_title')->nullable();
            $table->integer('counter_people_helped')->default(1000);
            $table->string('counter_people_helped_suffix')->default('+');
            $table->string('counter_people_helped_label')->default('PEOPLE HELPED');
            $table->integer('counter_volunteers')->default(50);
            $table->string('counter_volunteers_suffix')->default('+');
            $table->string('counter_volunteers_label')->default('ACTIVE VOLUNTEERS');
            $table->integer('counter_projects_done')->default(10);
            $table->string('counter_projects_done_suffix')->default('+');
            $table->string('counter_projects_done_label')->default('PROJECTS DONE');
            $table->integer('counter_communities')->default(10);
            $table->string('counter_communities_suffix')->default('+');
            $table->string('counter_communities_label')->default('COMMUNITIES');

            // About & Purpose Preview Section
            $table->string('about_subtitle')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_feature_1_title')->nullable();
            $table->string('about_feature_1_desc')->nullable();
            $table->string('about_feature_2_title')->nullable();
            $table->string('about_feature_2_desc')->nullable();

            // Newsletter Section
            $table->string('newsletter_subtitle')->nullable();
            $table->string('newsletter_title')->nullable();
            $table->text('newsletter_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
