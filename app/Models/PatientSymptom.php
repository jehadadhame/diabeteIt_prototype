<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PatientSymptom extends Model
{
    protected $fillable = [
        "patient_id",
        "symptom_id",
        "intensity",
        "reported_at",
    ];
}
