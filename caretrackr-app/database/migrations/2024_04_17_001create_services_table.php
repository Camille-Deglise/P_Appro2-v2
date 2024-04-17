<?php

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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
        });
        Schema::create('patient_service', function (Blueprint $table) {
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
            $table->primary(['patient_id','service_id']);
            $table->text('reason_hospitalization')->constrained()->cascadeOnDelete();
            $table->date('date_entry')->constrained()->cascadeOnDelete();
            $table->date('date_discharge')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_service');
        Schema::dropIfExists('services');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor(Service::class);
        });

    }
};