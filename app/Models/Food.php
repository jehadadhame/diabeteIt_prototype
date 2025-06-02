<?php

namespace App\Models;

use App\Constants\FilesConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Food extends Model
{
    protected $fillable = [
        'name',
        'arabic_name',
        'category_id',
        'image_name',
    ];
    protected $table = "foods";
    public const SMALL_IMAGES_PATH = FilesConstant::SMALL_IMAGES_PATH . "\\food";
    public const ORIGINAL_IMAGES_PATH = FilesConstant::ORIGINAL_IMAGES_PATH . "\\food";
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

    public function nutrients(): BelongsToMany
    {
        return $this->BelongsToMany(Nutrient::class, FoodNutrient::TABLE_NAME, 'food_id', 'nutrient_id')
            ->withPivot('amount', 'min', 'max', 'median');
    }

}
