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
            $table->string('vision_title')->nullable()->default('Empowered Communities Living with Dignity & Equality');
            $table->json('vision_points')->nullable();
            $table->string('mission_title')->nullable()->default('Transforming Lives Through Education & Healthcare');
            $table->json('mission_points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['vision_title', 'vision_points', 'mission_title', 'mission_points']);
        });
    }
};
