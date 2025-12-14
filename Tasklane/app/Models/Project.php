<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{

    // Columns
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'status'
    ];


   // Project has many tasks
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    // Project has many users and users can have many projects
    public function users(): BelongsToMany
    {
        // Pivot table is called teams
        return $this->belongsToMany(User::class, 'teams');
    }
}