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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('user_type', ['SUP', 'ADM', 'TCH', 'STU', 'PAR'])->default('STU');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // For single school - no school_id needed
            $table->softDeletes(); // For "deleted" users
            $table->boolean('is_active')->default(true); // Disable/enable users
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->string('two_factor_phone')->nullable();
            $table->json('two_factor_backup_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
