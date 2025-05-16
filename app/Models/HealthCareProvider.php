<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HealthCareProvider extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    public const TABLE_NAME = "health_care_providers";
    public const GUARD_NAME = "health_care_provider";
    public const API_GUARD_NAME = "health_care_provider_api";
    protected $guard = "health_care_provider";
    protected $table = "health_care_providers";
    protected $fillable = [
        'name',
        'email',
        'password',
        "service_type",
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

