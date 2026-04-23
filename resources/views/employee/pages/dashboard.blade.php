@extends('admin.layouts.main')

@section('title', 'Dashboard Karyawan')
@section('page-title', 'Dashboard Karyawan')

@section('content')
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Karyawan', 'url' => route('employee.dashboard')], ['label' => 'Dashboard']],
    ])

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h2 class="h4 mb-2">Selamat datang, {{ $user->name }}</h2>
            <p class="text-muted mb-3">Kelola pelaporan penjualan harian sesuai lokasi penugasan Anda.</p>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($user->locations as $location)
                    <span class="badge text-bg-light border">{{ $location->name }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @php
            $stats = [
                ['icon' => 'fa-location-dot', 'value' => $summary['assigned_locations'], 'label' => 'Lokasi Penugasan', 'color' => 'primary'],
                ['icon' => 'fa-box-open', 'value' => $summary['units_sold'], 'label' => 'Unit Terjual (Bulan ini)', 'color' => 'success'],
                ['icon' => 'fa-file-lines', 'value' => $summary['reports'], 'label' => 'Laporan (Bulan ini)', 'color' => 'warning'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden position-relative" style="border-radius: 20px; transition: transform 0.3s ease;">
                    <div class="card-body p-4 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; background: rgba(var(--bs-{{ $stat['color'] }}-rgb), 0.15); color: var(--bs-{{ $stat['color'] }});">
                                <i class="fa-solid {{ $stat['icon'] }} fa-lg"></i>
                            </div>
                            <div class="small fw-bold px-2 py-1 rounded-pill" style="background: rgba(var(--bs-{{ $stat['color'] }}-rgb), 0.1); color: var(--bs-{{ $stat['color'] }});">
                                Aktif
                            </div>
                        </div>
                        <h3 class="h2 fw-bold mb-1">{{ number_format($stat['value']) }}</h3>
                        <p class="text-muted mb-0 fw-medium">{{ $stat['label'] }}</p>
                    </div>
                    <!-- Decorative Element -->
                    <div class="position-absolute opacity-10" style="right: -10px; bottom: -10px; font-size: 5rem; color: var(--bs-{{ $stat['color'] }}); transform: rotate(-15deg);">
                        <i class="fa-solid {{ $stat['icon'] }}"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Laporan Terbaru</span>
            <a href="{{ route('employee.reports.create') }}" class="btn btn-sm btn-primary">Tambah Laporan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td>{{ $report->report_date->format('d/m/Y') }}</td>
                                <td>{{ $report->location->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('employee.reports.edit', $report) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">Belum ada laporan yang dibuat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
