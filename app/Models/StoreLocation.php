<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreLocation extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->where('role', 'employee')
            ->orderBy('name');
    }

    public function dailyReports(): HasMany
    {
        return $this->hasMany(DailyReport::class);
    }
}
