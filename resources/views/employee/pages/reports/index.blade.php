@extends('admin.layouts.main')

@section('title', 'Pelaporan Harian')
@section('page-title', 'Pelaporan Harian')

@section('content')
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Karyawan', 'url' => route('employee.dashboard')], ['label' => 'Pelaporan Harian']],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                <form method="GET" class="row g-2 flex-grow-1">
                    <div class="col-12 col-lg-4">
                        <input type="month" name="month" class="form-control" value="{{ request('month') }}">
                    </div>
                    <div class="col-12 col-lg-5">
                        <select name="location_id" class="form-select">
                            <option value="">Semua lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" @selected((string) request('location_id') === (string) $location->id)>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-3 d-grid">
                        <button class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <a href="{{ route('employee.reports.create') }}" class="btn btn-primary align-self-start">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Pelaporan
                </a>
            </div>

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
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $report->report_date->format('d/m/Y') }}</td>
                                <td>{{ $report->location->name }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('employee.reports.edit', $report) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="{{ route('employee.reports.print', $report) }}" class="btn btn-sm btn-outline-secondary">Print PDF</a>
                                        <form action="{{ route('employee.reports.destroy', $report) }}" method="POST"
                                            data-swal-confirm
                                            data-confirm-title="Hapus Laporan?"
                                            data-confirm-text="Laporan tanggal {{ $report->report_date->format('d/m/Y') }} akan dihapus permanen."
                                            data-confirm-button-text="Ya, hapus"
                                            data-cancel-button-text="Batal"
                                            data-confirm-icon="warning">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Belum ada laporan yang tersimpan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection
