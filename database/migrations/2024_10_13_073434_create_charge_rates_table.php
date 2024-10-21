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
        Schema::create('charge_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('charge');
            $table->unsignedBigInteger('type'); // Foreign key column for vehicle_types
            $table->unsignedBigInteger('model'); // Foreign key column for vehicle_models
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('charge_rates');
    }
};
