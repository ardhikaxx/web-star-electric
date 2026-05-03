<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyReport extends Model
{
    protected $fillable = [
        'user_id',
        'store_location_id',
        'report_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(StoreLocation::class, 'store_location_id');
    }

    public function productSales(): HasMany
    {
        return $this->hasMany(DailyReportProductSale::class)->orderBy('id');
    }

    public function sparepartSales(): HasMany
    {
        return $this->hasMany(DailyReportSparepartSale::class)->orderBy('id');
    }

    public function shippings(): HasMany
    {
        return $this->hasMany(DailyReportShipping::class)->orderBy('id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(DailyReportService::class)->orderBy('id');
    }

    public function calculateMetrics(): array
    {
        $productRevenue = (float) $this->productSales->sum('price');
        $productCost = (float) $this->productSales->sum(
            fn (DailyReportProductSale $sale) => $sale->payment_type === 'lunas' ? (float) ($sale->salesProduct?->purchase_price ?? 0) : 0
        );
        $sparepartRevenue = (float) $this->sparepartSales->sum('price');
        $shippingSales = (float) $this->shippings->where('shipping_type', 'sale')->sum('price');
        $returnShipping = (float) $this->shippings->where('shipping_type', 'return')->sum('price');
        $serviceRevenue = (float) $this->services->sum('price');
        $grossRevenue = $productRevenue + $sparepartRevenue + $shippingSales + $serviceRevenue;
        $profit = ($productRevenue - $productCost) + $sparepartRevenue + $shippingSales + $serviceRevenue - $returnShipping;

        return [
            'product_revenue' => $productRevenue,
            'product_cost' => $productCost,
            'sparepart_revenue' => $sparepartRevenue,
            'shipping_sales' => $shippingSales,
            'return_shipping' => $returnShipping,
            'service_revenue' => $serviceRevenue,
            'gross_revenue' => $grossRevenue,
            'profit' => $profit,
        ];
    }

    public function getGrossRevenueAttribute(): float
    {
        return $this->calculateMetrics()['gross_revenue'];
    }

    public function getProfitAttribute(): float
    {
        return $this->calculateMetrics()['profit'];
    }
}
