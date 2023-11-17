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
        Schema::create('search_logs_locate_msisdn', function (Blueprint $table) {
            $table->string('uuid', 40)->primary();
            $table->string('msisdn', 20);
            $table->string('imei', 20);
            $table->string('imsi', 20);
            $table->string('phone', 255);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);
            $table->string('operator', 100);
            $table->timestamps();
            
            $table->index('msisdn');
            $table->index('imei');
            $table->index('imsi');
        });

        Schema::create('search_logs_telco_registration', function (Blueprint $table) {
            $table->primary(['msisdn', 'nik']);
            $table->string('msisdn', 20);
            $table->string('nik', 20);
            $table->string('operator', 100);
            $table->timestamps();
            
            $table->index('msisdn');
            $table->index('nik');
        });

        Schema::create('search_logs_dukcapil', function (Blueprint $table) {
            $table->string('nik', 20)->primary();
            $table->string('nkk', 20);
            $table->string('religion', 100);
            $table->string('address', 999);
            $table->string('blood_type', 5);
            $table->string('gender', 15);
            $table->string('occupation', 50);
            $table->string('name', 255);
            $table->string('father', 255);
            $table->string('mother', 255);
            $table->string('education', 255);
            $table->string('marital', 15);
            $table->date('dob', 15);
            $table->string('photo_path', 255);
            $table->timestamps();
            
            $table->index('nkk');
            $table->index('religion');
            $table->index('address');
            $table->index('name');
            $table->index('father');
            $table->index('mother');
            $table->index('education');
            $table->index('dob');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_logs_locate_msisdn');
        Schema::dropIfExists('search_logs_telco_registration');
        Schema::dropIfExists('search_logs_dukcapil');
    }
};
