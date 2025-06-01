<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\HealthCareProvider;
use App\Models\Nutrient;
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

        Administrator::factory()->create([
            'name' => 'admin 0',
            'email' => 'admin_0@example.com',
        ]);

        $this->call(FoodCategorySeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(NutrientSeeder::class);
        $this->call(FoodNutrientSeeder::class);

    }
}
