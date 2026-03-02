<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainCheck extends Model
{

    protected $table = 'domains_checks';

    protected $fillable = [
        'domain_id',
        'status',
        'http_code',
        'response_time_ms',
        'error_message',
        'checked_at'
    ];

    protected function casts(): array {
        return [
            'checked_at' => 'datetime'
        ];
    }

    /**
     * Domain was checked.
     */
    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
}
