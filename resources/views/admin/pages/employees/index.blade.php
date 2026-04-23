@extends('admin.layouts.main')

@section('title', 'Manajemen Karyawan')
@section('page-title', 'Manajemen Karyawan')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Manajemen Karyawan']],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                <form class="row g-2 flex-grow-1" method="GET">
                    <div class="col-12 col-lg-5">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, username, atau nomor telepon" value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-lg-4">
                        <select name="location" class="form-select">
                            <option value="">Semua lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" @selected((string) request('location') === (string) $location->id)>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-3 d-grid">
                        <button class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <a href="{{ route('admin.employees.create') }}" class="btn btn-primary align-self-start">
                    <i class="fa-solid fa-user-plus me-2"></i>Tambah Karyawan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No. Telepon</th>
                            <th>Lokasi Tugas</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->username }}</td>
                                <td>{{ $employee->phone_number }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($employee->locations as $location)
                                            <span class="badge text-bg-light border">{{ $location->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="badge text-bg-{{ $employee->is_active ? 'success' : 'secondary' }}">
                                        {{ $employee->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST"
                                            data-swal-confirm
                                            data-confirm-title="Hapus Karyawan?"
                                            data-confirm-text="Karyawan {{ $employee->name }} akan dihapus secara permanen."
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
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
