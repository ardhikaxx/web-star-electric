<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('locations');
        $reports = DailyReport::query()
            ->with(['location', 'productSales.salesProduct', 'sparepartSales', 'shippings', 'services'])
            ->where('user_id', $user->id)
            ->orderByDesc('report_date')
            ->get();

        $currentMonthReports = $reports->filter(fn (DailyReport $report) => $report->report_date->isSameMonth(now()));
        $summary = $this->summarizeReports($currentMonthReports);
        $recentReports = $reports->take(5);

        return view('employee.pages.dashboard', compact('user', 'summary', 'recentReports'));
    }

    private function summarizeReports($reports): array
    {
        return $reports->reduce(function (array $carry, DailyReport $report): array {
            $carry['reports']++;
            return $carry;
        }, [
            'reports' => 0,
            'assigned_locations' => request()->user()->locations->count(),
        ]);
    }
}
