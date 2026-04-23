<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use App\Models\DailyReportShipping;
use App\Models\SalesProduct;
use App\Models\StoreLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('locations');

        $query = DailyReport::query()
            ->with(['location', 'productSales.salesProduct', 'sparepartSales', 'shippings', 'services'])
            ->where('user_id', $user->id)
            ->orderByDesc('report_date')
            ->orderByDesc('created_at');

        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('report_date', (int) $year)->whereMonth('report_date', (int) $month);
        }

        if ($request->filled('location_id')) {
            $query->where('store_location_id', $request->location_id);
        }

        $reports = $query->paginate(10)->withQueryString();

        return view('employee.pages.reports.index', [
            'reports' => $reports,
            'locations' => $user->locations,
        ]);
    }

    public function create(Request $request)
    {
        $locations = $request->user()->locations()->get();
        $salesProducts = SalesProduct::where('is_active', true)->orderBy('name')->get();

        return view('employee.pages.reports.create', [
            'report' => null,
            'locations' => $locations,
            'salesProducts' => $salesProducts,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user()->load('locations');
        $data = $this->validateReport($request, $user->locations->pluck('id')->all());
        $sections = $this->normalizeSections($request);

        DB::transaction(function () use ($user, $data, $sections): void {
            $report = DailyReport::create([
                'user_id' => $user->id,
                'store_location_id' => $data['store_location_id'],
                'report_date' => $data['report_date'],
                'notes' => $data['notes'] ?? null,
            ]);

            $this->syncReportSections($report, $sections);
        });

        return redirect()->route('employee.reports.index')->with('success', 'Pelaporan harian berhasil ditambahkan.');
    }

    public function edit(Request $request, DailyReport $dailyReport)
    {
        $report = $this->ownedReport($request, $dailyReport);
        $report->load(['location', 'productSales', 'sparepartSales', 'shippings', 'services']);

        return view('employee.pages.reports.edit', [
            'report' => $report,
            'locations' => $request->user()->locations,
            'salesProducts' => SalesProduct::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, DailyReport $dailyReport)
    {
        $report = $this->ownedReport($request, $dailyReport);
        $data = $this->validateReport($request, $request->user()->locations->pluck('id')->all(), $report->id);
        $sections = $this->normalizeSections($request);

        DB::transaction(function () use ($report, $data, $sections): void {
            $report->load('productSales');
            $this->restoreStocks($report);

            $report->update([
                'store_location_id' => $data['store_location_id'],
                'report_date' => $data['report_date'],
                'notes' => $data['notes'] ?? null,
            ]);

            $report->productSales()->delete();
            $report->sparepartSales()->delete();
            $report->shippings()->delete();
            $report->services()->delete();

            $this->syncReportSections($report, $sections);
        });

        return redirect()->route('employee.reports.index')->with('success', 'Pelaporan harian berhasil diperbarui.');
    }

    public function destroy(Request $request, DailyReport $dailyReport)
    {
        $report = $this->ownedReport($request, $dailyReport);

        DB::transaction(function () use ($report): void {
            $report->load('productSales');
            $this->restoreStocks($report);
            $report->delete();
        });

        return redirect()->route('employee.reports.index')->with('success', 'Pelaporan harian berhasil dihapus.');
    }

    public function print(Request $request, DailyReport $dailyReport)
    {
        $report = $this->ownedReport($request, $dailyReport);
        $report->load(['user', 'location', 'productSales.salesProduct', 'sparepartSales', 'shippings.productSale', 'services']);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('employee.pages.reports.pdf_export', compact('report'));
        
        $filename = 'Laporan_' . $report->report_date->format('Ymd') . '_' . $report->location->name . '.pdf';
        return $pdf->download($filename);
    }

    private function ownedReport(Request $request, DailyReport $dailyReport): DailyReport
    {
        abort_unless((int) $dailyReport->user_id === (int) $request->user()->id, 404);

        return $dailyReport;
    }

    private function validateReport(Request $request, array $locationIds, ?int $ignoreReportId = null): array
    {
        $rules = [
            'store_location_id' => ['required', Rule::in($locationIds)],
            'report_date' => [
                'required',
                'date',
                Rule::unique('daily_reports')
                    ->where('user_id', $request->user()->id)
                    ->where('store_location_id', $request->store_location_id)
                    ->ignore($ignoreReportId),
            ],
            'notes' => 'nullable|string',
        ];

        return $request->validate($rules, [
            'store_location_id.required' => 'Lokasi laporan wajib dipilih.',
            'store_location_id.in' => 'Lokasi laporan tidak termasuk penugasan Anda.',
            'report_date.unique' => 'Laporan untuk lokasi dan tanggal tersebut sudah ada.',
        ]);
    }

    private function normalizeSections(Request $request): array
    {
        return [
            'product_sales' => collect($request->input('product_sales', []))
                ->map(fn ($row) => [
                    'row_key' => trim((string) ($row['row_key'] ?? '')),
                    'sales_product_id' => $row['sales_product_id'] ?? null,
                    'product_type' => trim((string) ($row['product_type'] ?? '')),
                    'color' => trim((string) ($row['color'] ?? '')),
                    'payment_type' => trim((string) ($row['payment_type'] ?? '')),
                    'price' => $row['price'] ?? null,
                    'quantity' => $row['quantity'] ?? 1,
                ])
                ->filter(fn ($row) => $row['sales_product_id'] !== null || $row['product_type'] !== '' || $row['color'] !== '' || $row['payment_type'] !== '' || $row['price'] !== null)
                ->values()
                ->all(),
            'sparepart_sales' => collect($request->input('sparepart_sales', []))
                ->map(fn ($row) => [
                    'sparepart_name' => trim((string) ($row['sparepart_name'] ?? '')),
                    'price' => $row['price'] ?? null,
                ])
                ->filter(fn ($row) => $row['sparepart_name'] !== '' || $row['price'] !== null)
                ->values()
                ->all(),
            'shipping_sales' => collect($request->input('shipping_sales', []))
                ->map(fn ($row) => [
                    'product_row_key' => trim((string) ($row['product_row_key'] ?? '')),
                    'price' => $row['price'] ?? null,
                ])
                ->filter(fn ($row) => $row['product_row_key'] !== '' || $row['price'] !== null)
                ->values()
                ->all(),
            'return_shippings' => collect($request->input('return_shippings', []))
                ->map(fn ($row) => [
                    'product_name' => trim((string) ($row['product_name'] ?? '')),
                    'price' => $row['price'] ?? null,
                ])
                ->filter(fn ($row) => $row['product_name'] !== '' || $row['price'] !== null)
                ->values()
                ->all(),
            'services' => collect($request->input('services', []))
                ->map(fn ($row) => [
                    'service_name' => trim((string) ($row['service_name'] ?? '')),
                    'price' => $row['price'] ?? null,
                ])
                ->filter(fn ($row) => $row['service_name'] !== '' || $row['price'] !== null)
                ->values()
                ->all(),
        ];
    }

    private function syncReportSections(DailyReport $report, array $sections): void
    {
        $payload = [
            'product_sales' => $sections['product_sales'],
            'sparepart_sales' => $sections['sparepart_sales'],
            'shipping_sales' => $sections['shipping_sales'],
            'return_shippings' => $sections['return_shippings'],
            'services' => $sections['services'],
        ];

        validator($payload, [
            'product_sales.*.row_key' => 'required|string|max:100',
            'product_sales.*.sales_product_id' => 'required|exists:sales_products,id',
            'product_sales.*.product_type' => 'nullable|string|max:255',
            'product_sales.*.color' => 'nullable|string|max:255',
            'product_sales.*.payment_type' => 'required|in:dp,lunas',
            'product_sales.*.price' => 'required|numeric|min:0',
            'product_sales.*.quantity' => 'required|integer|min:1',
            'sparepart_sales.*.sparepart_name' => 'required|string|max:255',
            'sparepart_sales.*.price' => 'required|numeric|min:0',
            'shipping_sales.*.product_row_key' => 'required|string|max:100',
            'shipping_sales.*.price' => 'required|numeric|min:0',
            'return_shippings.*.product_name' => 'required|string|max:255',
            'return_shippings.*.price' => 'required|numeric|min:0',
            'services.*.service_name' => 'required|string|max:255',
            'services.*.price' => 'required|numeric|min:0',
        ])->validate();

        $productModels = [];
        $stockUsage = [];

        // Check stock availability first
        foreach ($sections['product_sales'] as $row) {
            $salesProduct = SalesProduct::find($row['sales_product_id']);
            if ($salesProduct) {
                $requestedQty = (int) $row['quantity'];
                $stockUsage[$salesProduct->id] = ($stockUsage[$salesProduct->id] ?? 0) + $requestedQty;
                
                if ($salesProduct->stock < $stockUsage[$salesProduct->id]) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'product_sales' => ["Stok produk '{$salesProduct->name}' tidak mencukupi (Sisa: {$salesProduct->stock})."]
                    ]);
                }
            }
        }

        foreach ($sections['product_sales'] as $row) {
            $salesProduct = SalesProduct::find($row['sales_product_id']);
            $productModel = $report->productSales()->create([
                'sales_product_id' => $salesProduct?->id,
                'row_key' => $row['row_key'],
                'product_name' => $salesProduct?->name,
                'product_type' => $row['product_type'] ?: null,
                'color' => $row['color'] ?: null,
                'payment_type' => $row['payment_type'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
            ]);

            $productModels[$row['row_key']] = $productModel;

            if ($salesProduct) {
                $salesProduct->updateStock(-(int)$row['quantity'], 'sale', $productModel);
            }
        }

        foreach ($sections['sparepart_sales'] as $row) {
            $report->sparepartSales()->create($row);
        }

        foreach ($sections['shipping_sales'] as $row) {
            $productModel = $productModels[$row['product_row_key']] ?? null;

            $report->shippings()->create([
                'report_product_sale_id' => $productModel?->id,
                'shipping_type' => 'sale',
                'product_name' => $productModel?->product_name,
                'price' => $row['price'],
            ]);
        }

        foreach ($sections['return_shippings'] as $row) {
            $report->shippings()->create([
                'shipping_type' => 'return',
                'product_name' => $row['product_name'],
                'price' => $row['price'],
            ]);
        }

        foreach ($sections['services'] as $row) {
            $report->services()->create($row);
        }
    }

    private function restoreStocks(DailyReport $report): void
    {
        foreach ($report->productSales as $sale) {
            if ($sale->sales_product_id) {
                $salesProduct = SalesProduct::find($sale->sales_product_id);
                if ($salesProduct) {
                    $salesProduct->updateStock($sale->quantity, 'cancel_sale', $sale);
                }
            }
        }
    }

    // applyStocks method is no longer needed as it's handled in syncReportSections

}
