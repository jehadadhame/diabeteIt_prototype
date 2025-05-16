<?php

namespace Database\Seeders;

use App\Models\HealthCareProvider;
use App\Models\Patient;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Patient::factory()->create([
            'name' => 'patient 0',
            'email' => 'patient_0@example.com',
        ]);

        HealthCareProvider::factory()->create([
            'name' => 'doctor 0',
            'email' => 'doctor_0@example.com',
            'service_type' => "doctors"
        ]);

        HealthCareProvider::factory()->create([
            'name' => 'dietitian 0',
            'email' => 'dietitian_0@example.com',
            'service_type' => "dietitians"
        ]);

    }
}
