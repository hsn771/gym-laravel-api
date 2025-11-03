<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipment_usages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipment_id');
            $table->bigInteger('operator_id')->nullable();
            $table->bigInteger('river_point_id')->nullable();
            $table->date('usage_date');
            $table->decimal('hours_used', 8, 2)->nullable();
            $table->decimal('fuel_used_liters', 8, 2)->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_usages');
    }
};
