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
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id');
            $table->integer('bus_id');
            $table->integer('route_id');
            //$table->time('departure_time');
            //$table->time('arrival_time');
            $table->datetime('departure_time');
            $table->datetime('arrival_time');
            $table->string('status');
            $table->integer('carrier_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
