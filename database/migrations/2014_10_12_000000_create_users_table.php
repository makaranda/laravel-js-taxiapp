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
            $table->string('phone',12);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address',255)->nullable();
            $table->string('gender',6)->nullable();
            $table->string('language',6)->default('en');
            $table->date('birthday')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'customer', 'driver', 'staff']);
            $table->rememberToken();
            $table->timestamps();
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
