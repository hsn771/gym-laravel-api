<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * •	id, point_name, location, gps_coordinates, description
     */
    public function up(): void
    {
        Schema::create('river_points', function (Blueprint $table) {
            $table->id();
            $table->string('point_name')->nullable();
            $table->string('location')->nullable();
            $table->string('gps_coordinates')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('river_points');
    }
};
