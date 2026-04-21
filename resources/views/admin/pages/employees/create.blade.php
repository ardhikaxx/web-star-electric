@extends('admin.layouts.main')

@section('title', 'Tambah Karyawan')
@section('page-title', 'Tambah Karyawan')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Manajemen Karyawan', 'url' => route('admin.employees.index')],
            ['label' => 'Tambah Karyawan'],
        ],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header">Form Karyawan</div>
        <div class="card-body">
            <form action="{{ route('admin.employees.store') }}" method="POST">
                @csrf
                @include('admin.pages.employees._form')
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">Simpan Karyawan</button>
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
