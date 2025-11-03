<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // খরচের নাম
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2); // খরচের পরিমাণ
            $table->date('expense_date')->nullable(); // খরচের তারিখ
            $table->enum('category', ['Fuel','Maintenance','Salary','Purchase','Other'])->default('Other');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
