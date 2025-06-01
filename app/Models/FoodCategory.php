<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $fillable = [
        'name',
        'arabic_name',
    ];
    protected $table = 'food_categories';
    public const TABLE = 'food_categories';

}
