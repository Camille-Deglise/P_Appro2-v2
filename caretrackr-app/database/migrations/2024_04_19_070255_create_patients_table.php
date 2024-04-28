<?php
use App\Models\HealthStatus;
use App\Models\Patient;
use App\Models\Service;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->tinyInteger('gender');
            $table->string('birth_date');
            $table->string('insurance');
            $table->string('avs_number');
            $table->string('road_number');
            $table->string('road');
            $table->integer('npa');
            $table->string('city');
            $table->string('country');
            $table->timestamps();
        });

        Schema::create('patient_service', function (Blueprint $table) {
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
            $table->primary(['patient_id','service_id']);
            $table->text('reason_hospitalization');
            $table->date('date_entry');
            $table->date('date_discharge')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('patient_service');
        Schema::dropIfExists('patients');
    }
};
