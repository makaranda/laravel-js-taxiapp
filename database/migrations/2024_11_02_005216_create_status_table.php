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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('booking_id');
            $table->enum('active', ['active', 'inactive'])->default('active');
            $table->tinyInteger('status')->default(1);
            $table->date('pick_up_date')->nullable(); // Date of pick up
            $table->time('pick_up_time')->nullable(); // Time of pick up
            $table->timestamps();

            // Foreign key for user_id
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // Foreign key for driver_id
            $table->foreign('driver_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // Foreign key for booking_id
            $table->foreign('booking_id')
            ->references('id')->on('bookings')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
