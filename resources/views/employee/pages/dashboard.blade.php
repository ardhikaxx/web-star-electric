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
        <div class="col-12 col-md-6">
            <div class="stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon primary bg-primary bg-opacity-10 text-primary rounded-circle p-3"><i class="fa-solid fa-location-dot fa-2x"></i></div>
                    <div class="stat-info">
                        <h3 class="mb-0">{{ number_format($summary['assigned_locations']) }}</h3>
                        <p class="text-muted mb-0">Lokasi penugasan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon warning bg-warning bg-opacity-10 text-warning rounded-circle p-3"><i class="fa-solid fa-file-lines fa-2x"></i></div>
                    <div class="stat-info">
                        <h3 class="mb-0">{{ number_format($summary['reports']) }}</h3>
                        <p class="text-muted mb-0">Laporan bulan ini</p>
                    </div>
                </div>
            </div>
        </div>
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
