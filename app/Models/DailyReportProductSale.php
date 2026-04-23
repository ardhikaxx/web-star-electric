<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportProductSale extends Model
{
    protected $fillable = [
        'daily_report_id',
        'sales_product_id',
        'row_key',
        'product_name',
        'product_type',
        'color',
        'payment_type',
        'price',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function dailyReport(): BelongsTo
    {
        return $this->belongsTo(DailyReport::class);
    }

    public function salesProduct(): BelongsTo
    {
        return $this->belongsTo(SalesProduct::class);
    }
}
