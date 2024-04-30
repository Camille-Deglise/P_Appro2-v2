<?php
use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mesured_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('temperature', total:3, places: 1)->nullable();
            $table->integer('systole')->nullable();
            $table->integer('diastole')->nullable();
            $table->integer('oxygen_saturation')->nullable();
            $table->integer('pulse')->nullable();
            $table->decimal('blood_sugar', total:3, places:1)->nullable();
            $table->dateTime('mesured_at');
            $table->foreignIdFor(Patient::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mesured_values', function (Blueprint $table) {
            $table->dropForeignIdFor(Patient::class);
          });
        Schema::dropIfExists('mesured_values');
    }
};
