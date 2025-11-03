<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_no'); // গাড়ির নাম্বার যেমন CH-12345
            $table->string('type'); // মিনি ট্রাক / ডাম্প ট্রাক
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->decimal('capacity_cft', 10, 2)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
