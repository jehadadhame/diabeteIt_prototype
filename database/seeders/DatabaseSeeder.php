<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\HealthCareProvider;
use App\Models\Nutrient;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;
    public function run(): void
    {

        Patient::create([
            'name' => 'patient 0',
            'email' => 'patient_0@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        HealthCareProvider::create([
            'name' => 'doctor 0',
            'email' => 'doctor_0@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'service_type' => "doctors"
        ]);

        HealthCareProvider::create([
            'name' => 'dietitian 0',
            'email' => 'dietitian_0@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'service_type' => "dietitians"
        ]);

        Administrator::create([
            'name' => 'admin 0',
            'email' => 'admin_0@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $this->call(FoodCategorySeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(NutrientSeeder::class);
        $this->call(FoodNutrientSeeder::class);

    }
}
