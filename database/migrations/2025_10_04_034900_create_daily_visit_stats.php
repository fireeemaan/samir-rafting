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
        Schema::create('daily_visit_stats', function (Blueprint $table) {
            $table->date('day');
            $table->string('path', 255)->default('');
            $table->unsignedInteger('visits');
            $table->unsignedInteger('unique_visitors');
            $table->unsignedInteger('signed_in_users');
            $table->primary(['day', 'path']);

            $table->index('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_visit_stats');
    }
};
