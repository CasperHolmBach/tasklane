<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Columns
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hidden columns for JSON serializations
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast function called by Eloquent ORM 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user can be a part of many projects and a project can have many users
    public function projects() : BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'teams');
    }
}
