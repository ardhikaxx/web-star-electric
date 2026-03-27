<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $inactiveProducts = max($totalProducts - $activeProducts, 0);
        $totalClicks = Product::sum('click_count');
        $totalUniqueClicks = Product::sum('unique_click_count');
        $clickStats = Product::query()
            ->select([
                'id',
                'name',
                'click_count',
                'unique_click_count',
                'interest_click_count',
                'last_clicked_at',
                'is_active',
            ])
            ->orderByDesc('click_count')
            ->orderByDesc('unique_click_count')
            ->orderBy('name')
            ->get();

        $topClickedProducts = $clickStats->take(5);
        $clickChartLabels = $clickStats
            ->map(fn (Product $product) => Str::limit($product->name, 24))
            ->values();
        $clickChartData = $clickStats->pluck('click_count')->values();

        return view('admin.pages.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalClicks',
            'totalUniqueClicks',
            'clickStats',
            'topClickedProducts',
            'clickChartLabels',
            'clickChartData',
        ));
    }
}
