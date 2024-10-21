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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id')->after('id'); // corrected spelling

        // Add foreign key constraint
        $table->foreign('reservation_id') // corrected spelling
              ->references('id')->on('reservations') // corrected spelling
              ->onDelete('cascade')
              ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']); // corrected spelling
            $table->dropColumn('reservation_id'); // corrected spelling
        });
    }
};
