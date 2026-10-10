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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Contact Information
            $table->string('email')->default('support@luminatrust.org');
            $table->string('phone')->default('+91 98947 77349');
            $table->string('secondary_phone')->nullable();
            $table->string('whatsapp_number')->default('+91 98947 77349');
            $table->string('address')->default('Lumina Trust, Nagapattinam, Tamil Nadu, India');
            $table->text('map_link')->nullable();
            $table->string('working_hours')->default('Mon – Sat: 9:00 AM – 6:00 PM');

            // Social Media Links
            $table->string('facebook_url')->nullable()->default('https://facebook.com');
            $table->string('twitter_url')->nullable()->default('https://twitter.com');
            $table->string('instagram_url')->nullable()->default('https://instagram.com');
            $table->string('youtube_url')->nullable()->default('https://youtube.com');
            $table->string('linkedin_url')->nullable()->default('https://linkedin.com');

            // Trust / Organization Details
            $table->string('site_title')->default('Lumina Trust');
            $table->string('site_tagline')->default('Empowering Communities, Transforming Lives');
            $table->string('registration_number')->nullable()->default('Trust Reg. No: 123/2018');
            $table->string('tax_exemption_info')->nullable()->default('Donations are tax exempt under 80G');
            $table->text('footer_about')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
