<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Domain extends Model
{
    protected $fillable = [
        'user_id',
        'url',
        'method',
        'check_interval_minutes',
        'timeout_seconds',
        'is_active',
        'last_checked_at'
    ];

    protected function casts(): array {
        return [
            'is_active' => 'boolean',
            'url' => 'string',
            'last_checked_at' => 'datetime',
        ];
    }


    public function checks(): HasMany {
        return $this->hasMany(DomainCheck::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function scopeWithLastCheck(Builder $query): Builder
    {
    return $query->withMax('checks', 'checked_at')
    ->withMax('checks', 'http_code');
    }
}
