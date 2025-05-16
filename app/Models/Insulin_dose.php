<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Insulin_dose extends Model
{
    protected $fillable = [
        "patient_id",
        "injected_at",
        "dose_units",
        "insulin_type",
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
