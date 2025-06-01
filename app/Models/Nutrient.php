<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
