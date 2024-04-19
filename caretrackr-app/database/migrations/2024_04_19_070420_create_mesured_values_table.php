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
            $table->decimal('temperature', total:2, places: 2);
            $table->integer('systole');
            $table->integer('diastole');
            $table->integer('oxygen_saturation');
            $table->integer('pulse');
            $table->decimal('bloog_sugar', total:2, places:2);
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