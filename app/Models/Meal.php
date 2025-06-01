<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Meal extends Model
{
    protected $fillable = [
        "name",
        "description",
        "carbs_grams",
        "protein_grams",
        "calories",
        "fat_grams",
        "fiber_grams",
        "glycemic_load",
        "net_carbs",
        "meal_type",
        "unit",
        "is_custom",
        "created_by",
        "image_name",
    ];

    public function patients(): MorphToMany
    {
        return $this->morphToMany(Patient::class, 'edibles', PatientEdible::TABLE_NAME)
            ->withPivot('quantity', 'eating_time');
    }
    public function foods(): HasManyThrough
    {
        return $this->hasManyThrough(Food::class, FoodInMeal::class);
    }
}
