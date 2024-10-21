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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone',12);
            $table->string('email')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->string('pick_up_location');
            $table->string('drop_off_location');
            $table->integer('distance');
            $table->integer('total_amount');
            $table->string('active');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
