<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blood_sugar_level extends Model
{
    protected $fillable = [
        "patient_id",
        "glucose_level",
        "measured_at",
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
