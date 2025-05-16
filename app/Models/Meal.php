<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    protected $fillable = [
        "name",
        "description",
        "carbs_grams",
        "protein_grams",
        "calories",
        "unit",
        "unit_value",
    ];
    public function patient(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'patients_meals', 'meal_id', 'patient_id');
    }
}
