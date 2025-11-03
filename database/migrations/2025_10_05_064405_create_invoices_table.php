<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('tender_owner_id')->nullable();
            $table->unsignedBigInteger('sand_type_id')->nullable();
            $table->date('invoice_date');
            $table->string('invoice_number')->unique();
            $table->decimal('quantity_cft', 12, 2)->nullable();
            $table->decimal('rate_per_cft', 10, 2)->nullable();
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->string('payment_status')->default('Pending'); // Pending, Paid, Partial
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
            $table->foreign('tender_owner_id')->references('id')->on('tender_owners')->onDelete('cascade');
            $table->foreign('sand_type_id')->references('id')->on('sand_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
