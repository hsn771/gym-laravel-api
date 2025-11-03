<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transport_rates', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type'); // যেমন মিনি ট্রাক/ডাম্প ট্রাক
            $table->decimal('capacity_cft', 10, 2)->nullable();
            $table->decimal('rate_per_trip', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_rates');
    }
};
