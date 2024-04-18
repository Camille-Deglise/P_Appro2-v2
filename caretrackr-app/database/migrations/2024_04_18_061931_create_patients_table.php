<?php

use App\Models\Health_Status;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->tinyInteger('gender');
            $table->string('insurance');
            $table->string('avs_number');
            $table->integer('road_number');
            $table->string('road');
            $table->integer('npa');
            $table->string('city');
            $table->string('country');
            $table->foreignIdFor(Health_Status::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeignIdFor(Health_Status::class);
        });
        Schema::dropIfExists('patients');
    }
};
