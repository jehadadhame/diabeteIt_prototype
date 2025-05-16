<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_disease extends Model
{
    protected $fillable = [
        "patient_id",
        "disease_id",
    ];
}
