<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesProduct extends Model
{
    protected $fillable = [
        'name',
        'purchase_price',
        'selling_price',
        'stock',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'purchase_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function reportProductSales(): HasMany
    {
        return $this->hasMany(DailyReportProductSale::class);
    }

    public function stockLogs()
    {
        return $this->morphMany(StockLog::class, 'stockable');
    }

    /**
     * Update stock and log the change
     */
    public function updateStock(int $change, string $type, ?Model $reference = null, ?string $notes = null): void
    {
        $before = $this->stock;
        $after = $before + $change;

        $this->update(['stock' => $after]);

        $this->stockLogs()->create([
            'change' => $change,
            'before_stock' => $before,
            'after_stock' => $after,
            'type' => $type,
            'reference_type' => $reference ? get_class($reference) : null,
            'reference_id' => $reference ? $reference->id : null,
            'user_id' => auth()->id(),
            'notes' => $notes,
        ]);
    }
}
