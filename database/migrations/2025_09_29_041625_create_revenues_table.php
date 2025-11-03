<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // আয়ের নাম
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2); // আয়ের পরিমাণ
            $table->date('revenue_date')->nullable(); // আয়ের তারিখ
            $table->enum('category', ['Sand Sale','Transport Fee','Other'])->default('Sand Sale');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
