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
            $table->string('phone')->nullable();
               $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
           $table->string('profile_image')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
             $table->string('status')->default('active');
             $table->string('otp')->nullable(); 
            $table->timestamp('otp_expires_at')->nullable();
             $table->string('reactivation_token')->nullable();
    $table->timestamp('reactivation_expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
   
    }
};
