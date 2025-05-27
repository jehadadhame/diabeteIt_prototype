<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'administrators';
    public const TABLE_NAME = 'administrators';
    public const GUARD_NAME = 'administrator';
    public const API_GUARD_NAME = 'administrator_api';
    protected $fillable = [
        'name',
        'email',
        'password',
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
