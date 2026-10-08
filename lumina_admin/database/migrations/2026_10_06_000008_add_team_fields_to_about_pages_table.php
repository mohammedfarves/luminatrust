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
            $table->string('team_subtitle')->nullable()->default('Leadership');
            $table->string('team_title')->nullable()->default('Meet Our Team');
            $table->text('team_description')->nullable();
            $table->json('team_members')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['team_subtitle', 'team_title', 'team_description', 'team_members']);
        });
    }
};
