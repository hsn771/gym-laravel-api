<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // নৌকার নাম
            $table->string('registration_no')->nullable(); // যদি থাকে
            $table->decimal('capacity_cft', 10, 2)->nullable(); // নৌকার ধারণক্ষমতা
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boats');
    }
};
