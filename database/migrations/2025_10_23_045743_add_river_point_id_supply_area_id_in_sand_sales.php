<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sand_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('river_point_id')->nullable()->after('quantity_cft');
            $table->unsignedBigInteger('supply_area_id')->nullable()->after('river_point_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sand_sales', function (Blueprint $table) {
            $table->dropColumn(['river_point_id', 'supply_area_id']);
        });
    }
};
