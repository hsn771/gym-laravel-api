<?php  

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // যন্ত্রপাতির নাম
            $table->string('type')->nullable(); // যেমন: Excavator, Pump, Loader
            $table->string('serial_no')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 12, 2)->nullable();
            $table->enum('status', ['Available', 'In Use', 'Under Maintenance', 'Broken'])->default('Available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
