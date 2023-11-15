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
        Schema::create('tracking_number_geo', function (Blueprint $table) {
            $table->string('geo_uuid', 40)->primary();
            $table->string('msisdn', 20);
            $table->string('action', 10);
            $table->integer('enabled')->default('1');
            $table->timestamps();

            $table->index(['msisdn']);
        });

        Schema::create('tracking_number_geo_points', function (Blueprint $table) {
            $table->primary(['geo_uuid', 'lat', 'long']);
            $table->string('geo_uuid', 40);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);

            $table->index(['geo_uuid']);
        });

        Schema::create('tracking_number_geo_breach', function (Blueprint $table) {
            $table->string('geo_breach_uuid', 40)->primary();
            $table->string('msisdn', 20);
            $table->string('action', 10);
            $table->timestamps();

            $table->unique(['msisdn', 'created_at']);
            $table->index(['msisdn']);
        });

        Schema::create('tracking_number_geo_breach_points', function (Blueprint $table) {
            $table->primary(['geo_breach_uuid', 'lat', 'long']);
            $table->string('geo_breach_uuid', 40);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);

            $table->index(['geo_breach_uuid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_number_geofences');
        Schema::dropIfExists('tracking_number_geofences_points');
        Schema::dropIfExists('tracking_number_breach');
        Schema::dropIfExists('tracking_number_breach_points');
    }
};
