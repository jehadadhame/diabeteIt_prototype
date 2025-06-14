<?php

namespace App\Models;

use App\Notifications\PatientResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    protected $guard = 'patient';
    protected $table = 'patients';
    public const TABLE_NAME = 'patients';

    public const GUARD_NAME = "patient";
    public const API_GUARD_NAME = "patient_api";
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PatientResetPassword($token));
    }
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function physical_data(): HasOne
    {
        return $this->hasOne(PatientPhysicalData::class);
    }
    public function diabetes_date(): HasOne
    {
        return $this->hasOne(PatientDiabetesData::class);
    }

    public function food_logs(): MorphToMany
    {
        return $this->morphedByMany(Food::class, 'edibles', PatientEdible::class);
    }
    public function allergic_foods(): HasManyThrough
    {
        return $this->hasManyThrough(Food::class, PatientAllergicFood::class);
    }
    public function medications(): HasManyThrough
    {
        return $this->hasManyThrough(Medication::class, PatientMedication::class);
    }

    public function diseases(): HasManyThrough
    {
        return $this->hasManyThrough(Disease::class, PatientDisease::class);
    }

    public function symptoms(): HasManyThrough
    {
        return $this->hasManyThrough(Symptom::class, PatientSymptom::class);
    }

    public function meal_logs(): MorphToMany
    {
        return $this->morphedByMany(PatientEdible::class, 'edibles', PatientEdible::TABLE_NAME);
    }
    public function exercises(): HasManyThrough
    {
        return $this->hasManyThrough(Exercise::class, PatientExercise::class);
    }

    public function blood_sugar_levels(): HasMany
    {
        return $this->hasMany(Blood_sugar_level::class);
    }
    public function insulin_doses(): HasMany
    {
        return $this->hasMany(Insulin_dose::class);
    }
    public function my_meal(): HasMany
    {
        return $this->hasMany(Meal::class, 'created_by');
    }
}
