<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boat_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boat_id')->constrained()->cascadeOnDelete();
            $table->foreignId('majhi_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('river_point_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('sale_point_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('trip_date');
            $table->decimal('quantity_cft', 12, 2)->nullable();
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boat_trips');
    }
};
