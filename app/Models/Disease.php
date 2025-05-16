<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disease extends Model
{
    protected $fillable = [
        "name",
    ];
    public function patient(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'patients_diseases', 'disease_id', 'patient_id');
    }
}
