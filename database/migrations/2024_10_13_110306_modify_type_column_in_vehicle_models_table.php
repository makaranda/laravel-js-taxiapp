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
        Schema::table('vehicle_models', function (Blueprint $table) {
            $table->unsignedBigInteger('types')->change();

            // Add foreign key constraint
            $table->foreign('types')
                  ->references('id')->on('vehicle_types')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_models', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['types']);

            // Revert 'type' column back to its original type (integer)
            $table->integer('types')->change();
        });
    }
};
