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
        Schema::table('about_pages', function (Blueprint $table) {
            $table->string('impact_subtitle')->nullable()->default('Areas of Impact');
            $table->string('impact_title')->nullable()->default('Where We Make a Difference');
            $table->text('impact_description')->nullable();
            $table->json('impact_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['impact_subtitle', 'impact_title', 'impact_description', 'impact_items']);
        });
    }
};
