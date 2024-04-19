<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Allergy;
use App\Models\HealthStatus;
use App\Models\MedicalHistory;
use App\Models\Medication;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Service::factory(7)->create();
        Medication::factory(24)->create();
        Allergy::factory(12)->create();
        MedicalHistory::factory(10)->create();
        HealthStatus::factory(4)->create();

    }
}
