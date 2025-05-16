<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Symptom extends Model
{
    protected $fillable = [
        "name",
    ];
    public function patient(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'patients_symptoms', 'symptom_id', 'patient_id');
    }
}
