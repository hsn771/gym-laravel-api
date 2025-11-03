<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fuel_consumptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipment_id')->nullable();
            $table->bigInteger('vehicle_id')->nullable();
            $table->bigInteger('boat_id')->nullable();
            $table->date('consumption_date');
            $table->decimal('fuel_quantity_liters', 10, 2);
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_consumptions');
    }
};
