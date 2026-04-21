@extends('admin.layouts.main')

@section('title', 'Produk Penjualan')
@section('page-title', 'Produk Penjualan')

@section('content')
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Produk Penjualan']],
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                <form method="GET" class="d-flex gap-2 flex-grow-1">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk penjualan" value="{{ request('search') }}">
                    <button class="btn btn-outline-primary">Cari</button>
                </form>
                <a href="{{ route('admin.sales-products.create') }}" class="btn btn-primary align-self-start">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Produk Penjualan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesProducts as $salesProduct)
                            <tr>
                                <td>{{ $salesProduct->name }}</td>
                                <td>{{ $currency($salesProduct->purchase_price) }}</td>
                                <td>{{ $currency($salesProduct->selling_price) }}</td>
                                <td>{{ number_format($salesProduct->stock) }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $salesProduct->is_active ? 'success' : 'secondary' }}">
                                        {{ $salesProduct->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.sales-products.edit', $salesProduct) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.sales-products.destroy', $salesProduct) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada produk penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $salesProducts->links() }}
            </div>
        </div>
    </div>
@endsection
