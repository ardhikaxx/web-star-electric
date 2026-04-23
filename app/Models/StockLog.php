<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockLog extends Model
{
    protected $fillable = [
        'stockable_type',
        'stockable_id',
        'change',
        'before_stock',
        'after_stock',
        'type',
        'reference_type',
        'reference_id',
        'user_id',
        'notes',
    ];

    public function stockable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
