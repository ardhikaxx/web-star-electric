@extends('admin.layouts.main')

@section('title', 'Tambah Toko Cabang')
@section('page-title', 'Tambah Toko Cabang')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Manajemen Toko Cabang', 'url' => route('admin.store-locations.index')],
            ['label' => 'Tambah'],
        ],
    ])

    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.store-locations.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Cabang Jakarta Pusat" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.store-locations.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
