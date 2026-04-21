<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportShipping extends Model
{
    protected $fillable = [
        'daily_report_id',
        'report_product_sale_id',
        'shipping_type',
        'product_name',
        'price',
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

    public function productSale(): BelongsTo
    {
        return $this->belongsTo(DailyReportProductSale::class, 'report_product_sale_id');
    }
}
