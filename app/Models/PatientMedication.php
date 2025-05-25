<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientMedication extends Model
{
    protected $fillable = [
        "patient_id",
        "drug_id",
    ];
}
