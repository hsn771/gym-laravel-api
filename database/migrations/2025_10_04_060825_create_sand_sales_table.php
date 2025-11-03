<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sand_sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
            $table->foreignId('sand_type_id')->constrained('sand_types')->onDelete('cascade');
            $table->decimal('quantity_cft', 12, 2)->default(0);
            $table->decimal('rate_per_cft', 12, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->enum('payment_status', ['pending', 'partial', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sand_sales');
    }
};
