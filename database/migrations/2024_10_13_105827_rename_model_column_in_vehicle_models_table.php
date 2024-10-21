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
            // Rename 'model' column to 'type'
            DB::statement('ALTER TABLE vehicle_models CHANGE model types BIGINT UNSIGNED');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_models', function (Blueprint $table) {
            DB::statement('ALTER TABLE vehicle_models CHANGE types model INT');
        });
    }
};
