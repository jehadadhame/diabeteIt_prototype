<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_exercise extends Model
{
    protected $fillable = [
        "patient_id",
        "exercise_id",
        "performed_at",
        "duration_min",
    ];
}
