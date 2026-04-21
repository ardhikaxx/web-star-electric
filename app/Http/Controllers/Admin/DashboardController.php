<?php

namespace App\Http\Controllers\Admin;

use App\Models\DailyReport;
use App\Models\Product;
use App\Models\SalesProduct;
use App\Models\StoreLocation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now();
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

        $reportCollection = DailyReport::query()
            ->with(['location', 'productSales.salesProduct', 'sparepartSales', 'shippings', 'services'])
            ->whereYear('report_date', $today->year)
            ->whereMonth('report_date', $today->month)
            ->get();

        $reportSummary = $this->summarizeReports($reportCollection);
        $profitByLocation = $reportCollection
            ->groupBy('location.name')
            ->map(fn (Collection $reports) => $this->summarizeReports($reports))
            ->sortByDesc('profit');

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
            'reportSummary',
            'profitByLocation',
            'today',
        ));
    }

    private function summarizeReports(Collection $reports): array
    {
        $summary = [
            'reports_count' => $reports->count(),
            'gross_revenue' => 0,
            'profit' => 0,
            'return_shipping' => 0,
            'total_employees' => User::where('role', 'employee')->count(),
            'total_locations' => StoreLocation::count(),
            'total_sales_products' => SalesProduct::count(),
        ];

        foreach ($reports as $report) {
            $metrics = $report->calculateMetrics();
            $summary['gross_revenue'] += $metrics['gross_revenue'];
            $summary['profit'] += $metrics['profit'];
            $summary['return_shipping'] += $metrics['return_shipping'];
        }

        return $summary;
    }
}
