<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Add role field
    ];

    // Attributes that should be hidden for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attributes that should be cast
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role-based access control methods
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Check if the user is a regular user
    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    // Define any additional relationships, like projects or permissions
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
