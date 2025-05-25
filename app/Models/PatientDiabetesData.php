<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientDiabetesData extends Model
{
    protected $fillable = [
        "patient_id",
        "daily_dose",
        "icr",
        "diagnosis_date",
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    //
}
