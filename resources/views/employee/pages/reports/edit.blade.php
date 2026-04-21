@extends('admin.layouts.main')

@section('title', 'Edit Pelaporan')
@section('page-title', 'Edit Pelaporan')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Karyawan', 'url' => route('employee.dashboard')],
            ['label' => 'Pelaporan Harian', 'url' => route('employee.reports.index')],
            ['label' => 'Edit Pelaporan'],
        ],
    ])

    <form action="{{ route('employee.reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')
        @include('employee.pages.reports._form')
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            <a href="{{ route('employee.reports.index') }}" class="btn btn-light border">Batal</a>
        </div>
    </form>
@endsection
