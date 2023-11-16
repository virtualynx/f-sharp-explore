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
        Schema::table('tracking_number_jobs', function (Blueprint $table) {
            $table->dropColumn([
                'cron_minute', 
                'cron_hour',
                'cron_dayofmonth',
                'cron_month',
                'cron_dayofweek'
            ]);

            $table->string('cron_notation', 255)->default('*/15 * * * *');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::table('tracking_number_jobs', function (Blueprint $table) {
            $table->dropColumn('cron_notation');
            
            $table->string('cron_minute', 5)->nullable();
            $table->string('cron_hour', 5)->nullable();
            $table->string('cron_dayofmonth', 5)->nullable();
            $table->string('cron_month', 5)->nullable();
            $table->string('cron_dayofweek', 5)->nullable();
        });
    }
};
