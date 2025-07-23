<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'rut',
        'name', // nombre
        'email', // correo
        'password', // contraseña
        'role', // rol
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Set default values for attributes.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = 'common';
            }
        });
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function username()
    {
        return 'rut';
    }
}