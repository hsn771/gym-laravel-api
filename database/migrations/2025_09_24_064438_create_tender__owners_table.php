// database/migrations/2025_09_24_000003_create_tender_owners_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tender_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_id')->constrained()->cascadeOnDelete();
            $table->string('owner_name');
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_owners');
    }
};
