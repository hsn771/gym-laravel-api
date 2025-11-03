<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_owner_id')->nullable();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('contract_value', 12, 2)->nullable();
            $table->string('status')->default('Active'); // Active, Completed, Cancelled
            $table->text('terms')->nullable();
            $table->timestamps();

            $table->foreign('tender_owner_id')->references('id')->on('tender_owners')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
