<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Food extends Model
{
    protected $fillable = [
        'name',
        'calories',
        'carbs_grams',
        'fiber_grams',
        'protein_grams',
        'fat_grams',
        'net_carbs',
        'glycemic_index',
        'glycemic_load',
        'unit',
        'image_url',
    ];
    protected $table = "foods";
    public const TABLE_NAME = 'foods';
    // public function patients(): BelongsToMany
    // {
    //     return $this->belongsToMany(Patient::class, 'patients_allergic_foods', 'food_id', 'patient_id');
    // }
    public function patients(): MorphToMany
    {
        return $this->morphToMany(Patient::class, 'edibles', PatientEdible::TABLE_NAME)
            ->withPivot('quantity', 'eating_time');
    }
    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, FoodInMeal::TABLE_NAME, 'food_id', 'meal_id');
    }
    public function patients_alargic_to(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, PatientAllergicFood::TABLE_NAME, 'food_id', 'patient_id');
    }
}
