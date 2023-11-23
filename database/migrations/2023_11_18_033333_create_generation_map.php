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
        Schema::create('generation_map', function (Blueprint $table) {
            $table->string('gen_id', 20)->primary();;
            $table->string('name', 20);
            $table->integer('lowerbound')->nullable();
            $table->integer('upperbound')->nullable();
            
            $table->index('lowerbound');
            $table->index('upperbound');
            $table->index(['lowerbound', 'upperbound']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generation_map');
    }
};
