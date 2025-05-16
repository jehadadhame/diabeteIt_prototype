<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    protected $fillable = [
        "name",
        "cal_per_min",
    ];

    public function patinet(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'patients_exercises', 'exercise_id', 'patient_id');
    }
}
