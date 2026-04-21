@extends('admin.layouts.main')

@section('title', 'Laporan Admin')
@section('page-title', 'Laporan Admin')

@section('content')
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Laporan Admin']],
    ])

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-12 col-md-3">
                    <label class="form-label">Jenis Laporan</label>
                    <select name="view" class="form-select">
                        <option value="monthly" @selected($view === 'monthly')>Per Bulan</option>
                        <option value="yearly" @selected($view === 'yearly')>Per Tahun</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="year" class="form-control" value="{{ $year }}">
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Bulan</label>
                    <select name="month" class="form-select" {{ $view === 'yearly' ? 'disabled' : '' }}>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" @selected($month === $i)>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Lokasi</label>
                    <select name="location_id" class="form-select">
                        <option value="">Semua lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @selected((string) request('location_id') === (string) $location->id)>{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Karyawan</label>
                    <select name="employee_id" class="form-select">
                        <option value="">Semua karyawan</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" @selected((string) request('employee_id') === (string) $employee->id)>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 d-grid d-md-flex justify-content-md-end">
                    <button class="btn btn-primary px-4">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="stat-icon primary"><i class="fa-solid fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($summary['gross_revenue']) }}</h3>
                    <p>Omzet {{ $periodLabel }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="stat-icon success"><i class="fa-solid fa-sack-dollar"></i></div>
                <div class="stat-info">
                    <h3>{{ $currency($summary['profit']) }}</h3>
                    <p>Keuntungan {{ $periodLabel }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="stat-icon warning"><i class="fa-solid fa-file-lines"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($summary['reports']) }}</h3>
                    <p>Jumlah laporan {{ $periodLabel }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Rekap Per Lokasi</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Lokasi</th>
                                    <th>Laporan</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locationSummary as $location => $item)
                                    <tr>
                                        <td>{{ $location }}</td>
                                        <td>{{ number_format($item['reports']) }}</td>
                                        <td>{{ $currency($item['profit']) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header">Rekap Per Karyawan</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Karyawan</th>
                                    <th>Laporan</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employeeSummary as $employee => $item)
                                    <tr>
                                        <td>{{ $employee }}</td>
                                        <td>{{ number_format($item['reports']) }}</td>
                                        <td>{{ $currency($item['profit']) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header">Daftar Laporan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Karyawan</th>
                            <th>Lokasi</th>
                            <th>Omzet</th>
                            <th>Keuntungan</th>
                            <th class="text-end">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            @php $metrics = $report->calculateMetrics(); @endphp
                            <tr>
                                <td>{{ $report->report_date->format('d/m/Y') }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->location->name }}</td>
                                <td>{{ $currency($metrics['gross_revenue']) }}</td>
                                <td>{{ $currency($metrics['profit']) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.reports.show', $report) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada laporan pada filter yang dipilih.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
