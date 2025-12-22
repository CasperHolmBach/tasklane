<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    // Columns
    protected $fillable = [
        'project_id', // Foreign key to project
        'title',
        'description',
        'due_date',
        'status',
        'priority',
        'assigned_user_id', // Fk to user that is assigned
    ];

    // A task belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}