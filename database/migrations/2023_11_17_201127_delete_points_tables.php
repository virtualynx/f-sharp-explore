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
        Schema::dropIfExists('tracking_number_geo_points');
        Schema::dropIfExists('tracking_number_geo_breach_points');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::create('tracking_number_geo_points', function (Blueprint $table) {
            $table->primary(['geo_uuid', 'lat', 'long']);
            $table->string('geo_uuid', 40);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);

            $table->index(['geo_uuid']);
        });
        
        Schema::create('tracking_number_geo_breach_points', function (Blueprint $table) {
            $table->primary(['geo_breach_uuid', 'lat', 'long']);
            $table->string('geo_breach_uuid', 40);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);

            $table->index(['geo_breach_uuid']);
        });
    }
};
