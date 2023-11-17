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
        Schema::create('locate_msisdn_logs', function (Blueprint $table) {
            $table->string('uuid', 40)->primary();
            $table->string('msisdn', 20);
            $table->string('imei', 20);
            $table->string('imsi', 20);
            $table->string('phone', 255);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);
            $table->timestamps();
            
            $table->index('msisdn');
            $table->index('imei');
            $table->index('imsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locate_msisdn_logs');
    }
};
