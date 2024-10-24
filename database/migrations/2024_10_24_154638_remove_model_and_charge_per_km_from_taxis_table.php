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
        Schema::table('taxis', function (Blueprint $table) {
            $table->dropForeign(['model']);
            $table->dropColumn(['model', 'charge_per_km']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taxis', function (Blueprint $table) {
            $table->string('model')->nullable();
            $table->integer('charge_per_km')->nullable();

            $table->foreign('model')
            ->references('id')->on('vehicle_models')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }
};
