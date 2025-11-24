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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email', 191)->unique(); // Reduced to 191 to fit MySQL key length limit with utf8mb4
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email', 191)->primary(); // Reduced to 191 to fit MySQL key length limit with utf8mb4
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Sessions table is now handled by separate migration: 2025_11_24_210240_create_sessions_table.php
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        // Sessions table is handled by separate migration: 2025_11_24_210240_create_sessions_table.php
    }
};
