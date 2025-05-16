<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food_item extends Model
{
    protected $fillable = [
        "name",
        "carbs_grm",
    ];
    public function patient(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'patients_allergic_foods', 'food_id', 'patient_id');
    }
}
