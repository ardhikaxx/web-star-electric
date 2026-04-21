<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use App\Models\StoreLocation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->input('view', 'monthly');
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);

        $query = DailyReport::query()
            ->with(['user', 'location', 'productSales.salesProduct', 'sparepartSales', 'shippings', 'services'])
            ->orderByDesc('report_date')
            ->orderByDesc('created_at');

        if ($view === 'yearly') {
            $query->whereYear('report_date', $year);
        } else {
            $query->whereYear('report_date', $year)->whereMonth('report_date', $month);
        }

        if ($request->filled('location_id')) {
            $query->where('store_location_id', $request->location_id);
        }

        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }

        $reports = $query->get();
        $summary = $this->summarizeReports($reports);
        $locationSummary = $reports->groupBy('location.name')->map(fn ($group) => $this->summarizeReports($group));
        $employeeSummary = $reports->groupBy('user.name')->map(fn ($group) => $this->summarizeReports($group));

        $locations = StoreLocation::orderBy('name')->get();
        $employees = User::where('role', 'employee')->orderBy('name')->get();
        $periodLabel = $view === 'yearly'
            ? 'Tahun ' . $year
            : Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');

        return view('admin.pages.reports.index', compact(
            'reports',
            'summary',
            'locationSummary',
            'employeeSummary',
            'locations',
            'employees',
            'view',
            'year',
            'month',
            'periodLabel',
        ));
    }

    public function show(DailyReport $dailyReport)
    {
        $dailyReport->load(['user.locations', 'location', 'productSales.salesProduct', 'sparepartSales', 'shippings.productSale', 'services']);
        $metrics = $dailyReport->calculateMetrics();

        return view('admin.pages.reports.show', compact('dailyReport', 'metrics'));
    }

    private function summarizeReports($reports): array
    {
        return $reports->reduce(function (array $carry, DailyReport $report): array {
            $metrics = $report->calculateMetrics();

            $carry['reports']++;
            $carry['gross_revenue'] += $metrics['gross_revenue'];
            $carry['profit'] += $metrics['profit'];
            $carry['return_shipping'] += $metrics['return_shipping'];

            return $carry;
        }, [
            'reports' => 0,
            'gross_revenue' => 0,
            'profit' => 0,
            'return_shipping' => 0,
        ]);
    }
}
