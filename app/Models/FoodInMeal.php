<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodInMeal extends Model
{
    public const TABLE_NAME = 'foods_in_meals';
    protected $table = "foods_in_meals";
    protected $fillable = [
        "food_id",
        "meal_id",
        "quantity",
    ];

}
