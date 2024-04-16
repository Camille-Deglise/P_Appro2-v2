<?php

use App\Models\Health_Status;
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
        Schema::create('health_status', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->foreignIdFor(Health_Status::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_status');
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeignIdFor(Health_Status::class);
        });
    }
};
