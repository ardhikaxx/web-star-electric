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
}
