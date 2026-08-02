@extends('admin.layouts.main')

@section('title', 'Manajemen Toko Cabang')
@section('page-title', 'Manajemen Toko Cabang')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Manajemen Toko Cabang']],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                <form class="row g-2 flex-grow-1" method="GET">
                    <div class="col-12 col-lg-8">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama lokasi" value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-lg-4 d-grid">
                        <button class="btn btn-outline-primary">Cari</button>
                    </div>
                </form>
                <a href="{{ route('admin.store-locations.create') }}" class="btn btn-primary align-self-start">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Lokasi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Jumlah Karyawan</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $index => $location)
                            <tr>
                                <td>{{ $locations->firstItem() + $index }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->employees()->count() }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.store-locations.edit', $location) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.store-locations.destroy', $location) }}" method="POST"
                                            data-swal-confirm
                                            data-confirm-title="Hapus Lokasi?"
                                            data-confirm-text="Lokasi {{ $location->name }} akan dihapus secara permanen."
                                            data-confirm-button-text="Ya, hapus"
                                            data-cancel-button-text="Batal"
                                            data-confirm-icon="warning">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit" @if($location->employees()->exists() || $location->dailyReports()->exists()) disabled title="Tidak bisa dihapus karena masih terkait data lain" @endif>Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data toko cabang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $locations->links() }}
            </div>
        </div>
    </div>
@endsection
