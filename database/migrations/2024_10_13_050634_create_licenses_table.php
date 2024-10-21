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
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->string('license_type', 50);
            $table->date('registered_date');
            $table->date('expired_date');
            $table->string('license_front_img')->nullable();
            $table->string('license_back_img')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            // Foreign key constraint to users table
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
