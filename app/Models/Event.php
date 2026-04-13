<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'description', 'location',
        'organizer', 'start_date', 'end_date', 'image',
        'is_published', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
