@extends('admin.layouts.main')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@push('styles')
    <style>
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 24px;
            padding: clamp(1.45rem, 2.6vw, 2rem);
            margin-bottom: 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            inset: auto -10% -35% auto;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            inset: -22% auto auto 8%;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .welcome-banner-copy,
        .quick-actions {
            position: relative;
            z-index: 1;
        }

        .welcome-banner h2 {
            font-size: clamp(1.45rem, 1.2rem + 1vw, 1.95rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .welcome-banner p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
            max-width: 660px;
            line-height: 1.7;
        }

        .quick-actions {
            display: flex;
            gap: 0.9rem;
            margin-top: 1.45rem;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.24);
            color: #fff;
            padding: 0.8rem 1rem;
            border-radius: 14px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: all 0.2s ease;
            min-height: 48px;
        }

        .quick-action-btn:hover {
            background: #fff;
            color: var(--primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 22px;
            padding: 1.2rem 1.25rem;
            box-shadow: 0 18px 42px rgba(8, 19, 33, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid rgba(16, 33, 50, 0.06);
            min-height: 120px;
        }

        .stats-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .stats-icon.primary {
            background: linear-gradient(135deg, rgba(255, 2, 5, 0.16), rgba(255, 2, 5, 0.06));
            color: var(--primary);
        }

        .stats-icon.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.06));
            color: var(--success);
        }

        .stats-icon.muted {
            background: linear-gradient(135deg, rgba(96, 112, 128, 0.15), rgba(96, 112, 128, 0.06));
            color: var(--muted);
        }

        .stats-icon.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.18), rgba(245, 158, 11, 0.08));
            color: var(--warning);
        }

        .stats-icon.dark {
            background: linear-gradient(135deg, rgba(16, 33, 50, 0.14), rgba(16, 33, 50, 0.06));
            color: var(--text);
        }

        .stats-info h3 {
            font-size: clamp(1.55rem, 1.35rem + 0.7vw, 1.95rem);
            font-weight: 700;
            margin: 0 0 0.25rem;
            color: var(--text);
            line-height: 1.05;
        }

        .stats-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 18px 42px rgba(8, 19, 33, 0.06);
            overflow: hidden;
            border: 1px solid rgba(16, 33, 50, 0.06);
        }

        .info-card-header {
            padding: 1.2rem 1.35rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            gap: 0.9rem;
        }

        .info-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 2, 5, 0.1);
            color: var(--primary);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-card-heading {
            min-width: 0;
        }

        .info-card-heading h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
        }

        .info-card-heading p {
            margin: 0.3rem 0 0;
            font-size: 0.84rem;
            color: var(--muted);
            line-height: 1.6;
        }

        .info-card-body {
            padding: 1.25rem 1.35rem 1.35rem;
        }

        .chart-shell {
            position: relative;
            min-height: 340px;
        }

        .analytics-empty {
            min-height: 320px;
            border-radius: 20px;
            border: 1px dashed rgba(16, 33, 50, 0.14);
            background: linear-gradient(180deg, rgba(244, 248, 251, 0.75), rgba(255, 255, 255, 0.95));
            display: grid;
            place-items: center;
            text-align: center;
            padding: 2rem;
        }

        .analytics-empty-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 1rem;
            border-radius: 22px;
            display: grid;
            place-items: center;
            background: rgba(255, 2, 5, 0.1);
            color: var(--primary);
            font-size: 1.65rem;
        }

        .analytics-empty h4 {
            margin: 0 0 0.45rem;
            color: var(--text);
            font-size: 1.05rem;
            font-weight: 700;
        }

        .analytics-empty p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            max-width: 420px;
        }

        .ranking-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .ranking-item {
            display: flex;
            gap: 0.9rem;
            align-items: flex-start;
            padding: 0.95rem 1rem;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(244, 248, 251, 0.92), rgba(255, 255, 255, 0.98));
            border: 1px solid rgba(16, 33, 50, 0.06);
        }

        .ranking-rank {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-weight: 700;
            font-size: 0.86rem;
            flex-shrink: 0;
            box-shadow: 0 12px 24px rgba(255, 2, 5, 0.2);
        }

        .ranking-content {
            min-width: 0;
            flex: 1;
        }

        .ranking-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.55rem;
        }

        .ranking-head h4 {
            margin: 0;
            font-size: 0.96rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.45;
        }

        .ranking-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.34rem 0.7rem;
            border-radius: 999px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            flex-shrink: 0;
        }

        .ranking-status.active {
            background: rgba(16, 185, 129, 0.14);
            color: var(--success);
        }

        .ranking-status.inactive {
            background: rgba(96, 112, 128, 0.14);
            color: var(--muted);
        }

        .ranking-metrics {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            margin-bottom: 0.45rem;
        }

        .ranking-metrics span {
            display: inline-flex;
            align-items: center;
            gap: 0.38rem;
            padding: 0.4rem 0.65rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(16, 33, 50, 0.06);
            color: var(--muted);
            font-size: 0.74rem;
            font-weight: 700;
            line-height: 1;
        }

        .ranking-content p {
            margin: 0;
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.55;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(16, 33, 50, 0.06);
        }

        .info-item:first-child {
            padding-top: 0;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: rgba(244, 248, 251, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-content h4 {
            margin: 0 0 0.25rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
        }

        .info-content p {
            margin: 0;
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        @media (max-width: 991.98px) {
            .quick-actions {
                gap: 0.8rem;
            }

            .chart-shell {
                min-height: 320px;
            }
        }

        @media (max-width: 767.98px) {
            .welcome-banner {
                padding: 1.35rem;
                border-radius: 22px;
            }

            .quick-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .quick-action-btn {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stats-card,
            .info-card {
                border-radius: 20px;
            }

            .stats-card {
                padding: 1.1rem;
            }

            .stats-icon {
                width: 54px;
                height: 54px;
                border-radius: 16px;
            }

            .chart-shell,
            .analytics-empty {
                min-height: 300px;
            }

            .ranking-head {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 575.98px) {
            .info-card-header,
            .info-card-body {
                padding-inline: 1rem;
            }

            .ranking-item {
                padding: 0.9rem;
            }

            .ranking-rank {
                width: 36px;
                height: 36px;
                border-radius: 12px;
            }

            .analytics-empty {
                padding: 1.5rem 1rem;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $hasClickData = $clickStats->isNotEmpty() && $totalClicks > 0;
    @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Dashboard']],
    ])

    <div class="welcome-banner">
        <div class="welcome-banner-copy">
            <h2>Dashboard performa produk dan minat pengunjung</h2>
            <p>Pantau produk aktif, total klik tombol beli, klik unik, dan minat pembeli pada produk yang belum memiliki link pembelian langsung.</p>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                <i class="fa-solid fa-plus"></i>
                Tambah Produk
            </a>
            <a href="{{ route('admin.products.index') }}" class="quick-action-btn">
                <i class="fa-solid fa-box"></i>
                Lihat Produk
            </a>
            <a href="{{ url('/') }}" target="_blank" class="quick-action-btn">
                <i class="fa-solid fa-eye"></i>
                Lihat Website
            </a>
        </div>
    </div>

    <div class="stats-grid mb-4">
        <div class="stats-card">
            <div class="stats-icon primary">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($totalProducts) }}</h3>
                <p>Total produk yang tersimpan di katalog admin.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon success">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($activeProducts) }}</h3>
                <p>Produk aktif yang tampil di landing page.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon muted">
                <i class="fa-solid fa-eye-slash"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($inactiveProducts) }}</h3>
                <p>Produk nonaktif yang masih tersimpan.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon primary">
                <i class="fa-solid fa-hand-pointer"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($totalClicks) }}</h3>
                <p>Total klik tombol beli dari seluruh produk.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon warning">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($totalUniqueClicks) }}</h3>
                <p>Klik unik per sesi pengunjung.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon dark">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <div class="stats-info">
                <h3>{{ number_format($totalInterestClicks) }}</h3>
                <p>Minat pembeli pada produk yang belum punya link.</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-8">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <div class="info-card-heading">
                        <h3>Grafik Klik Produk</h3>
                        <p>Setiap batang mewakili jumlah klik tombol beli untuk satu produk pada landing page.</p>
                    </div>
                </div>
                <div class="info-card-body">
                    @if ($hasClickData)
                        <div class="chart-shell">
                            <canvas id="productClicksChart"></canvas>
                        </div>
                    @else
                        <div class="analytics-empty">
                            <div>
                                <div class="analytics-empty-icon">
                                    <i class="fa-solid fa-chart-column"></i>
                                </div>
                                <h4>Belum ada data klik produk</h4>
                                <p>Grafik akan tampil otomatis setelah pengunjung mulai menekan tombol beli pada landing page.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <div class="info-card-heading">
                        <h3>Produk Paling Diminati</h3>
                        <p>Urutan produk dengan klik terbanyak untuk membantu evaluasi katalog.</p>
                    </div>
                </div>
                <div class="info-card-body">
                    @if ($clickStats->isEmpty())
                        <div class="analytics-empty">
                            <div>
                                <div class="analytics-empty-icon">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h4>Belum ada produk</h4>
                                <p>Tambahkan produk terlebih dahulu untuk mulai melihat peringkat minat pengunjung.</p>
                            </div>
                        </div>
                    @elseif ($totalClicks === 0)
                        <div class="analytics-empty">
                            <div>
                                <div class="analytics-empty-icon">
                                    <i class="fa-solid fa-hand-pointer"></i>
                                </div>
                                <h4>Belum ada interaksi pembeli</h4>
                                <p>Daftar produk paling diminati akan muncul saat data klik dari landing page mulai terkumpul.</p>
                            </div>
                        </div>
                    @else
                        <div class="ranking-list">
                            @foreach ($topClickedProducts as $index => $product)
                                <div class="ranking-item">
                                    <div class="ranking-rank">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="ranking-content">
                                        <div class="ranking-head">
                                            <h4>{{ $product->name }}</h4>
                                            <span class="ranking-status {{ $product->is_active ? 'active' : 'inactive' }}">
                                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                        <div class="ranking-metrics">
                                            <span>
                                                <i class="fa-solid fa-hand-pointer"></i>
                                                {{ number_format($product->click_count) }} klik
                                            </span>
                                            <span>
                                                <i class="fa-solid fa-users"></i>
                                                {{ number_format($product->unique_click_count) }} unik
                                            </span>
                                            <span>
                                                <i class="fa-solid fa-bell-concierge"></i>
                                                {{ number_format($product->interest_click_count) }} minat
                                            </span>
                                        </div>
                                        <p>
                                            {{ $product->last_clicked_at ? 'Klik terakhir ' . $product->last_clicked_at->format('d M Y, H:i') : 'Belum ada data klik terakhir.' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div class="info-card-heading">
                        <h3>Informasi Sistem</h3>
                        <p>Ringkasan area admin untuk pengelolaan website dan keamanan akses.</p>
                    </div>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div class="info-content">
                            <h4>Admin Panel</h4>
                            <p>Kelola produk, lihat statistik klik, dan perbarui konten website dari satu tempat.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="info-content">
                            <h4>STAR SEPEDA LISTRIK</h4>
                            <p>Website publik menampilkan produk aktif dan mencatat minat pengunjung pada tombol beli.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="info-content">
                            <h4>Keamanan</h4>
                            <p>Gunakan PIN admin secara hati-hati dan perbarui secara berkala untuk menjaga akses panel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div class="info-card-heading">
                        <h3>Quick Links</h3>
                        <p>Akses cepat ke alur kerja yang paling sering dipakai di admin panel.</p>
                    </div>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-icon" style="background: var(--primary-light-alpha);">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="info-content">
                            <h4>Tambah Produk Baru</h4>
                            <p><a href="{{ route('admin.products.create') }}" class="text-decoration-none" style="color: var(--primary);">Klik di sini</a> untuk menambahkan produk baru ke website.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon" style="background: var(--success-light-alpha); color: var(--success);">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="info-content">
                            <h4>Kelola Produk</h4>
                            <p><a href="{{ route('admin.products.index') }}" class="text-decoration-none" style="color: var(--primary);">Klik di sini</a> untuk melihat katalog, status, dan performa klik setiap produk.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon" style="background: var(--warning-light-alpha); color: var(--warning);">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="info-content">
                            <h4>Landing Page</h4>
                            <p><a href="{{ url('/') }}" target="_blank" class="text-decoration-none" style="color: var(--primary);">Klik di sini</a> untuk melihat tampilan website publik dan menguji tracking produk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartCanvas = document.getElementById('productClicksChart');

            if (!chartCanvas) {
                return;
            }

            const labels = @json($clickChartLabels);
            const clickData = @json($clickChartData);
            const numberFormatter = new Intl.NumberFormat('id-ID');

            new Chart(chartCanvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Klik',
                        data: clickData,
                        backgroundColor: 'rgba(255, 2, 5, 0.82)',
                        borderColor: 'rgba(218, 0, 3, 1)',
                        borderWidth: 1,
                        borderRadius: 12,
                        borderSkipped: false,
                        maxBarThickness: 42,
                        hoverBackgroundColor: 'rgba(218, 0, 3, 0.9)'
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
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            displayColors: false,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return numberFormatter.format(context.parsed.y) + ' klik';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#607080',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: '#607080',
                                callback: function(value) {
                                    return numberFormatter.format(value);
                                }
                            },
                            grid: {
                                color: 'rgba(16, 33, 50, 0.08)',
                                drawBorder: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
