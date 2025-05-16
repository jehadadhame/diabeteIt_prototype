<?php

namespace App\Models;

use App\Notifications\PatientResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    protected $guard = 'patient';
    public const GUARD_NAME = "patient";
    public const API_GUARD_NAME = "patient-api";
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
        return $this->hasOne(Patient_physical_data::class);
    }
    public function diabetes_date(): HasOne
    {
        return $this->hasOne(Patient_diabetes_data::class);
    }

    public function allergic_foods(): HasManyThrough
    {
        return $this->hasManyThrough(Food_item::class, Patient_allergic_food::class);
    }
    public function medications(): HasManyThrough
    {
        return $this->hasManyThrough(Medication::class, Patient_medication::class);
    }

    public function diseases(): HasManyThrough
    {
        return $this->hasManyThrough(Disease::class, Patient_disease::class);
    }

    public function symptoms(): HasManyThrough
    {
        return $this->hasManyThrough(Symptom::class, Patient_symptom::class);
    }

    public function meals(): HasManyThrough
    {
        return $this->hasManyThrough(Meal::class, Patient_meal::class);
    }
    public function exercises(): HasManyThrough
    {
        return $this->hasManyThrough(Exercise::class, Patient_exercise::class);
    }

    public function blood_sugar_levels(): HasMany
    {
        return $this->hasMany(Blood_sugar_level::class);
    }
    public function insulin_doses(): HasMany
    {
        return $this->hasMany(Insulin_dose::class);
    }
}
