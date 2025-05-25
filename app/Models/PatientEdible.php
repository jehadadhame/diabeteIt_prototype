<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientEdible extends Model
{
    protected $fillable = [
        "patient_id",
        "edibles_id",
        "edibles_type",
        "quantity",
        "eating_time",
    ];
    protected $table = 'patients_edibles';
    public const TABLE_NAME = 'patients_edibles';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function edible()
    {
        return $this->morphTo(__FUNCTION__, 'edibles_type', 'edibles_id');
    }
}
