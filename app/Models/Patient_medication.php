<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_medication extends Model
{
    protected $fillable = [
        "patient_id",
        "drug_id",
    ];
}
