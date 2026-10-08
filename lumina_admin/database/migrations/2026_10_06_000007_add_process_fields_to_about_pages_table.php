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
            $table->string('process_subtitle')->nullable()->default('Our Process');
            $table->string('process_title')->nullable()->default('How We Work');
            $table->text('process_description')->nullable();
            $table->json('process_steps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['process_subtitle', 'process_title', 'process_description', 'process_steps']);
        });
    }
};
