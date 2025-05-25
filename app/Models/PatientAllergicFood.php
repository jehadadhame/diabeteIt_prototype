<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAllergicFood extends Model
{
    protected $fillable = [
        "food_id",
        "patient_id",
    ];
    protected $table = 'patients_allergic_foods';
    public const TABLE_NAME = 'patients_allergic_foods';
}
