<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('equipment_id')->nullable();
            $table->BigInteger('vehicle_id')->nullable();
            $table->BigInteger('boat_id')->nullable();
            $table->date('maintenance_date');
            $table->string('maintenance_type')->nullable(); // e.g., Oil Change, Engine Repair, etc.
            $table->decimal('cost', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
     });
    }
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};