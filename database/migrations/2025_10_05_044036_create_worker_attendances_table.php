<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('worker_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained()->cascadeOnDelete();
            $table->foreignId('river_point_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('attendance_date');
            $table->enum('status', ['Present', 'Absent', 'Leave'])->default('Present');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_attendances');
    }
};
