<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sand_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('river_point_id')->constrained('river_points')->onDelete('cascade');
            $table->foreignId('sand_type_id')->constrained('sand_types')->onDelete('cascade');
            $table->decimal('available_quantity_cft', 12, 2)->default(0);
            $table->timestamps(); // includes created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sand_stocks');
    }
};
