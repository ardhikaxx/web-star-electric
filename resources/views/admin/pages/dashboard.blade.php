@extends('admin.layouts.main')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
    @php
        $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
    @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Dashboard']],
    ])

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
                        <div>
                            <h2 class="h4 mb-2">Ringkasan keuntungan laporan {{ $today->translatedFormat('F Y') }}</h2>
                            <p class="text-muted mb-0">Pantau omzet, keuntungan, dan total laporan karyawan dari tiga lokasi toko.</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-user-plus me-2"></i>Tambah Karyawan
                            </a>
                            <a href="{{ route('admin.sales-products.create') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-plus me-2"></i>Tambah Produk Penjualan
                            </a>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-chart-line me-2"></i>Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon primary"><i class="fa-solid fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($reportSummary['gross_revenue']) }}</h3>
                    <p>Omzet laporan bulan ini</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon success"><i class="fa-solid fa-sack-dollar"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($reportSummary['profit']) }}</h3>
                    <p>Keuntungan bersih bulan ini</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon warning"><i class="fa-solid fa-file-lines"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($reportSummary['reports_count']) }}</h3>
                    <p>Total laporan bulan ini</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon muted"><i class="fa-solid fa-truck-fast"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($reportSummary['return_shipping']) }}</h3>
                    <p>Total ongkir retur bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Tren Omzet 7 Hari Terakhir</span>
                    <span class="badge text-bg-light border">Harian</span>
                </div>
                <div class="card-body">
                    <canvas id="salesTrendChart" style="height: 220px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h6 mb-3">Operasional</h3>
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted">Jumlah karyawan</span>
                        <strong>{{ number_format($reportSummary['total_employees']) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted">Jumlah lokasi</span>
                        <strong>{{ number_format($reportSummary['total_locations']) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Produk penjualan</span>
                        <strong>{{ number_format($reportSummary['total_sales_products']) }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h6 mb-3">Katalog Website</h3>
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted">Produk katalog</span>
                        <strong>{{ number_format($totalProducts) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted">Produk aktif</span>
                        <strong>{{ number_format($activeProducts) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Produk nonaktif</span>
                        <strong>{{ number_format($inactiveProducts) }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="h6 mb-3">Klik Pengunjung</h3>
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted">Total klik</span>
                        <strong>{{ number_format($totalClicks) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Klik unik</span>
                        <strong>{{ number_format($totalUniqueClicks) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Keuntungan Per Lokasi Bulan Ini</div>
                <div class="card-body">
                    @if ($profitByLocation->isEmpty())
                        <div class="text-muted">Belum ada laporan karyawan pada periode ini.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>Jumlah Laporan</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profitByLocation as $locationName => $summary)
                                        <tr>
                                            <td>{{ $locationName }}</td>
                                            <td>{{ number_format($summary['reports_count']) }}</td>
                                            <td>{{ $currency($summary['profit']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Produk Katalog Paling Banyak Diklik</div>
                <div class="card-body">
                    @if ($topClickedProducts->isEmpty())
                        <div class="text-muted">Belum ada data klik produk.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Status</th>
                                        <th>Total Klik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topClickedProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <span class="badge text-bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($product->click_count) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('salesTrendChart').getContext('2d');
                const currencyFormatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($salesChartLabels) !!},
                        datasets: [{
                            label: 'Omzet Harian',
                            data: {!! json_encode($salesChartData) !!},
                            borderColor: '#E53935',
                            backgroundColor: 'rgba(229, 57, 53, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#E53935',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#102132',
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    size: 13
                                },
                                padding: 12,
                                cornerRadius: 10,
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + currencyFormatter.format(context.parsed.y);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    drawBorder: false,
                                    color: 'rgba(16, 33, 50, 0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'jt';
                                        if (value >= 1000) return 'Rp ' + (value / 1000) + 'rb';
                                        return 'Rp ' + value;
                                    },
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
