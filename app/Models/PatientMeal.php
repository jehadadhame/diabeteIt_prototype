<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientMeal extends Model
{
    protected $fillable = [
        'patient_id',
        'meal_id',
        'quantity',
        'meal_time',
    ];
    protected $table = 'patients_meal';
    public const TABLE_NAME = 'patients_meal';
}
