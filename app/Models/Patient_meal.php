<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_meal extends Model
{
    protected $fillable = [
        "patient_id",
        "meal_id",
        "meal_time",
    ];
}
