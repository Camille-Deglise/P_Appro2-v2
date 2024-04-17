<?php
use App\Models\Patient;
use App\Models\Medical_Background;
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
        Schema::create('medical_backgroud', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('medical_background_patient', function (Blueprint $table) {
            $table->foreignIdFor(Medical_Background::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->primary(['medication_background_id','patient_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_background_patient');
        Schema::dropIfExists('medical_backgroud');
    }
};
