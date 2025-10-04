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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            $table->timestamp('occurred_at');
            $table->foreignId('user_id')->nullable();
            $table->string('session_id', 64)->nullable();
            $table->string('ip_hash', 64);
            $table->string('path', 255);
            $table->string('method', 8);
            $table->string('referer', 255)->nullable();
            $table->string('utm_source', 64)->nullable();
            $table->string('utm_medium', 64)->nullable();
            $table->string('utm_campaign', 64)->nullable();
            $table->boolean('is_bot')->default(false);
            $table->string('ua', 255)->nullable();

            $table->index('occurred_at');
            $table->index('user_id');
            $table->index('session_id');
            $table->index('ip_hash');
            $table->index('path');
            $table->index('is_bot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
