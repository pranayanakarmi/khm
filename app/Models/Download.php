<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Download extends Model
{
    protected $fillable = [
        'title', 'category', 'description', 'file_path', 'file_name',
        'file_size', 'is_active', 'sort_order', 'download_count',
        'created_by', 'updated_by',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
