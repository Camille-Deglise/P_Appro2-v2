<?php
use App\Models\Medication;
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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->timestamps();
        });
        Schema::create('medication_patient', function (Blueprint $table) {
            $table->foreignIdFor(Medication::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->primary(['medication_id','patient_id']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_patient');
        Schema::dropIfExists('medications');
    }
};
