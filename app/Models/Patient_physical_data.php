<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient_physical_data extends Model
{
    protected $fillable = [
        "patient_id",
        "height",
        "weight",
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
