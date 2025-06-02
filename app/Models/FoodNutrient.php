<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodNutrient extends Model
{
    protected $fillable = [
        "food_id",
        "nutrient_id",
        "amount",
        "min",
        "max",
        "median",
    ];
    protected $table = 'foods_nutrients';
    public const TABLE_NAME = 'foods_nutrients';
}
