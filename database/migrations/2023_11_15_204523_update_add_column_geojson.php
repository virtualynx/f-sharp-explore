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
        Schema::table('tracking_number_geo', function (Blueprint $table) {
            $table->string('geojson', 9999)->nullable();
        });
        Schema::table('tracking_number_geo_breach', function (Blueprint $table) {
            $table->string('geojson', 9999)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracking_number_geo', function (Blueprint $table) {
            $table->dropColumn('geojson');
        });
        Schema::table('tracking_number_geo_breach', function (Blueprint $table) {
            $table->dropColumn('geojson');
        });
    }
};
