<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nutrient extends Model
{
    protected $fillable = [
        'name',
        'arabic_name',
        'unit_name',
        'type',
    ];
    protected $table = 'nutrients';
    public const TABLE_NAME = 'nutrients';

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, FoodNutrient::class, 'food_id', 'nutrient_id');
    }
}
