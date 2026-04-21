@extends('admin.layouts.main')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan')

@section('content')
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Laporan Admin', 'url' => route('admin.reports.index')],
            ['label' => 'Detail Laporan'],
        ],
    ])

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="text-muted small">Tanggal Laporan</div>
                    <strong>{{ $dailyReport->report_date->translatedFormat('d F Y') }}</strong>
                </div>
                <div class="col-12 col-md-4">
                    <div class="text-muted small">Karyawan</div>
                    <strong>{{ $dailyReport->user->name }}</strong>
                </div>
                <div class="col-12 col-md-4">
                    <div class="text-muted small">Lokasi</div>
                    <strong>{{ $dailyReport->location->name }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon primary"><i class="fa-solid fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($metrics['gross_revenue']) }}</h3>
                    <p>Omzet</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon success"><i class="fa-solid fa-sack-dollar"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($metrics['profit']) }}</h3>
                    <p>Keuntungan</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon warning"><i class="fa-solid fa-arrow-trend-down"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($metrics['product_cost']) }}</h3>
                    <p>Total HPP Produk</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="stat-icon muted"><i class="fa-solid fa-truck-fast"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($metrics['return_shipping']) }}</h3>
                    <p>Ongkir Retur</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Penjualan Produk</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Pembayaran</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dailyReport->productSales as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->product_type ?: '-' }}</td>
                                        <td>{{ $item->color ?: '-' }}</td>
                                        <td>{{ strtoupper($item->payment_type) }}</td>
                                        <td>{{ $currency($item->price) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted">Tidak ada data penjualan produk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Sparepart, Ongkir, dan Service</div>
                <div class="card-body">
                    <h4 class="h6 mb-3">Penjualan Sparepart</h4>
                    <ul class="list-group mb-4">
                        @forelse ($dailyReport->sparepartSales as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item->sparepart_name }}</span>
                                <strong>{{ $currency($item->price) }}</strong>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada penjualan sparepart.</li>
                        @endforelse
                    </ul>

                    <h4 class="h6 mb-3">Ongkir</h4>
                    <ul class="list-group mb-4">
                        @forelse ($dailyReport->shippings as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item->shipping_type === 'sale' ? 'Ongkir Penjualan' : 'Ongkir Retur' }} - {{ $item->product_name ?: '-' }}</span>
                                <strong>{{ $currency($item->price) }}</strong>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada data ongkir.</li>
                        @endforelse
                    </ul>

                    <h4 class="h6 mb-3">Perbaikan / Service</h4>
                    <ul class="list-group">
                        @forelse ($dailyReport->services as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item->service_name }}</span>
                                <strong>{{ $currency($item->price) }}</strong>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada data service.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
