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
        Schema::create('taxis', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            $table->unsignedBigInteger('user_id'); // Foreign key column

            $table->string('title');
            $table->unsignedBigInteger('type'); // Foreign key column for vehicle_types
            $table->unsignedBigInteger('model'); // Foreign key column for vehicle_models
            $table->string('doors', 50);
            $table->string('passengers', 50);
            $table->string('luggage_carry', 50);
            $table->string('transmission', 50);
            $table->string('year', 50);
            $table->string('fuel_type', 50);
            $table->string('air_condition', 50);
            $table->string('gps', 50);
            $table->string('engine', 50);
            $table->string('registered_no', 50);
            $table->string('image');
            $table->text('description');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            // Foreign key for user_id
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Foreign key for type (vehicle_types)
            $table->foreign('type')
                ->references('id')->on('vehicle_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Foreign key for model (vehicle_models)
            $table->foreign('model')
                ->references('id')->on('vehicle_models')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxis');
    }
};
