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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('age')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('role')->default('user')->after('profile_photo'); // Tambahkan kolom role
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->string('name');
            $table->string('cover');
            $table->year('release_year');
            $table->string('director');
            $table->string('studio');
            $table->timestamps();
        });
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
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
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user_favorites');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('users');
    }
    
};
