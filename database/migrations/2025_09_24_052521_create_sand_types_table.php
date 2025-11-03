// database/migrations/2025_09_24_000002_create_sand_types_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sand_types', function (Blueprint $table) {
            $table->id();
            $table->string('sand_name');
            $table->string('quality_grade')->nullable();
            $table->decimal('price_per_cft', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sand_types');
    }
};
