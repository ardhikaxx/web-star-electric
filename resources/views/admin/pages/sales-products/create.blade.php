@extends('admin.layouts.main')

@section('title', 'Tambah Produk Penjualan')
@section('page-title', 'Tambah Produk Penjualan')

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Produk Penjualan', 'url' => route('admin.sales-products.index')],
            ['label' => 'Tambah Produk Penjualan'],
        ],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header">Form Produk Penjualan</div>
        <div class="card-body">
            <form action="{{ route('admin.sales-products.store') }}" method="POST">
                @csrf
                @include('admin.pages.sales-products._form')
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">Simpan Produk</button>
                    <a href="{{ route('admin.sales-products.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
