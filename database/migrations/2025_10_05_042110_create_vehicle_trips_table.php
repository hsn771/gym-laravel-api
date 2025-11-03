<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id')->unsigned()->index();
            $table->bigInteger('river_point_id')->nullable()->unsigned()->index();
            $table->bigInteger('sale_point_id')->nullable()->unsigned()->index();
            $table->bigInteger('transport_rate_id')->nullable()->unsigned()->index();
            $table->date('trip_date');
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->decimal('quantity_cft', 12, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_trips');
    }
};
