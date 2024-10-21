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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id')->nullable()->default(null);
            $table->string('pick_up_location');
            $table->string('drop_off_location');

            // Adding new columns
            $table->integer('passengers'); // Number of passengers
            $table->integer('vehicle_type'); // Vehicle type as a string (or you can use enum if you want to restrict to specific types)
            $table->date('pick_up_date'); // Date of pick up
            $table->time('pick_up_time'); // Time of pick up

            // Use enum for active column to represent different states
            $table->enum('active', ['pending', 'active', 'inactive'])->default('pending');

            $table->tinyInteger('status')->default(1); // 1 for active, 0 for inactive, etc.
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('driver_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
