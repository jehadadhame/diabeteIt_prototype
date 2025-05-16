<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_allergic_food extends Model
{
    protected $fillable = [
        "food_id",
        "patient_id",
    ];
}
