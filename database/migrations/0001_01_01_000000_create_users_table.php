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
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // team information
            $table->string('agency');
            $table->enum('robot_category', ['Robot Sumo', 'Obstacle Avoidance']);

            $table->string('participant_one_name')->nullable();
            $table->string('participant_one_nim_or_nis')->nullable();

            $table->string('participant_two_name')->nullable();
            $table->string('participant_two_nim_or_nis')->nullable();

            $table->string('participant_three_name')->nullable();
            $table->string('participant_three_nim_or_nis')->nullable();

            $table->string('participant_four_name')->nullable();
            $table->string('participant_four_nim_or_nis')->nullable();

            $table->string('participant_five_name')->nullable();
            $table->string('participant_five_nim_or_nis')->nullable();
            // end of team information

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
