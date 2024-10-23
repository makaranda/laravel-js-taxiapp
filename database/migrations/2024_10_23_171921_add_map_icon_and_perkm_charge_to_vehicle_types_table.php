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
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->string('map_icon')->nullable()->after('icon');
            $table->integer('perkm_charge')->nullable()->after('map_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->dropColumn('map_icon');
            $table->dropColumn('perkm_charge');
        });
    }
};
