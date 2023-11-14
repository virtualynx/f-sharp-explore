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
        Schema::create('tracking_number_jobs', function (Blueprint $table) {
            $table->string('msisdn', 20)->primary();
            $table->string('name', 200);
            $table->string('group', 200)->nullable();
            $table->integer('running')->default('0');
            $table->string('cron_minute', 5)->nullable();
            $table->string('cron_hour', 5)->nullable();
            $table->string('cron_dayofmonth', 5)->nullable();
            $table->string('cron_month', 5)->nullable();
            $table->string('cron_dayofweek', 5)->nullable();
            // $table->timestamp('last_tracked')->nullable();
            $table->timestamps();

            $table->index(['group']);
        });

        Schema::create('tracking_number_logs', function (Blueprint $table) {
            $table->string('uuid', 40)->primary();
            $table->string('msisdn', 20);
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);
            $table->integer('success');
            $table->string('error_message', 255)->nullable();
            $table->timestamps();

            // $table->foreignId('msisdn')->constrained('tracking_number_jobs');

            $table->unique(['msisdn', 'created_at']);
            $table->index(['msisdn']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_number_jobs');
        Schema::dropIfExists('tracking_number_logs');
    }
};
