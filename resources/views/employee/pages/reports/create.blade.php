@extends('admin.layouts.main')

@section('title', 'Tambah Pelaporan')
@section('page-title', 'Tambah Pelaporan')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Karyawan', 'url' => route('employee.dashboard')],
            ['label' => 'Pelaporan Harian', 'url' => route('employee.reports.index')],
            ['label' => 'Tambah Pelaporan'],
        ],
    ])

    <form action="{{ route('employee.reports.store') }}" method="POST">
        @csrf
        @include('employee.pages.reports._form')
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Simpan Pelaporan</button>
            <a href="{{ route('employee.reports.index') }}" class="btn btn-light border">Batal</a>
        </div>
    </form>
@endsection
