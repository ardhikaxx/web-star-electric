@extends('admin.layouts.main')

@section('title', 'Manajemen Produk - Admin')

@push('styles')
    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .page-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            box-shadow: 0 8px 24px rgba(12, 143, 116, 0.3);
            flex-shrink: 0;
        }

        .page-header-info h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
        }

        .page-header-info .subtitle {
            font-size: 0.85rem;
            color: var(--muted);
            margin: 0.25rem 0 0;
        }

        .btn-tambah-wrapper {
            display: inline-block;
        }

        .btn-tambah {
            position: relative;
            background: linear-gradient(135deg, var(--primary) 0%, #0a6b5a 100%);
            color: #fff;
            border: none;
            padding: 0;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(12, 143, 116, 0.35);
            overflow: hidden;
            height: 52px;
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(12, 143, 116, 0.45);
            color: #fff;
        }

        .btn-tambah-icon {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .btn-tambah-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0 1.25rem 0 0.75rem;
            gap: 0.05rem;
        }

        .btn-tambah-title {
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .btn-tambah-subtitle {
            font-size: 0.7rem;
            font-weight: 400;
            opacity: 0.8;
        }

        .btn-tambah::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-tambah:hover::before {
            transform: translateX(100%);
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card-mini {
            background: var(--surface-strong);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, rgba(12, 143, 116, 0.15), rgba(12, 143, 116, 0.05));
            color: var(--primary);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.05));
            color: #10b981;
        }

        .stat-icon.inactive {
            background: linear-gradient(135deg, rgba(107, 114, 128, 0.15), rgba(107, 114, 128, 0.05));
            color: #6b7280;
        }

        .stat-info h4 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
        }

        .stat-info p {
            margin: 0;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: var(--surface-strong);
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .product-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(12, 143, 116, 0.15);
        }

        .product-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image-container img {
            transform: scale(1.05);
        }

        .product-status-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-status-badge.active {
            background: rgba(16, 185, 129, 0.95);
            color: #fff;
        }

        .product-status-badge.inactive {
            background: rgba(107, 114, 128, 0.95);
            color: #fff;
        }

        .product-content {
            padding: 1.25rem;
        }

        .product-content h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-content p {
            font-size: 0.8rem;
            color: var(--muted);
            margin: 0 0 1rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .product-price {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }

        .current-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .old-price {
            font-size: 0.85rem;
            color: var(--muted);
            text-decoration: line-through;
        }

        .product-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            background: var(--bg);
            border-radius: 8px;
            font-size: 0.75rem;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .product-link-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .product-actions {
            display: flex;
            gap: 0.75rem;
            padding-top: 1rem;
            border-top: 1px solid var(--line);
        }

        .btn-action {
            flex: 1;
            padding: 0.65rem;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: rgba(12, 143, 116, 0.1);
            color: var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
        }

        .alert-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .alert-toast.success {
            background: #10b981;
            color: #fff;
        }

        .alert-toast.error {
            background: var(--danger);
            color: #fff;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(12, 143, 116, 0.1) 0%, rgba(12, 143, 116, 0.05) 100%);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 3rem;
            color: var(--primary);
        }

        .empty-state h3 {
            color: var(--text);
            font-size: 1.35rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .empty-state p {
            color: var(--muted);
            margin-bottom: 1.5rem;
        }

        .pagination-wrap {
            display: flex;
            justify-content: center;
            padding: 2rem 0 1rem;
        }

        .pagination-wrap .pagination {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-wrap .page-item .page-link {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            background: var(--surface-strong);
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .pagination-wrap .page-item .page-link:hover {
            background: var(--primary);
            color: #fff;
        }

        .pagination-wrap .page-item.active .page-link {
            background: var(--primary);
            color: #fff;
        }

        @media (max-width: 767.98px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .page-header-left {
                flex-direction: column;
            }

            .btn-tambah {
                justify-content: center;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        @include('admin.partials.breadcrumb', [
            'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Produk']],
        ])

        @if (session('success'))
            <div class="alert-toast success" id="alertToast">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-toast error" id="alertToast">
                <i class="fa-solid fa-circle-xmark"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="page-header d-flex align-items-center justify-content-between mb-3">
            <div class="page-header-left">
                <div class="page-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="page-header-info">
                    <h2>Manajemen Produk</h2>
                    <p class="subtitle">Kelola semua produk Anda di satu tempat</p>
                </div>
            </div>
            <div class="btn-tambah-wrapper">
                <a href="{{ route('admin.products.create') }}" class="btn-tambah">
                    <div class="btn-tambah-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="btn-tambah-text">
                        <span class="btn-tambah-title">Tambah Produk</span>
                        <span class="btn-tambah-subtitle">Buat produk baru</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
            <div class="col-md-3 ms-auto">
                <form action="{{ route('admin.products.index') }}" method="GET">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-card-mini">
                <div class="stat-icon total">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="stat-info">
                    <h4>{{ $products->total() }}</h4>
                    <p>Total Produk</p>
                </div>
            </div>
            <div class="stat-card-mini">
                <div class="stat-icon active">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h4>{{ $products->where('is_active', true)->count() }}</h4>
                    <p>Produk Aktif</p>
                </div>
            </div>
            <div class="stat-card-mini">
                <div class="stat-icon inactive">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <div class="stat-info">
                    <h4>{{ $products->where('is_active', false)->count() }}</h4>
                    <p>Produk Nonaktif</p>
                </div>
            </div>
        </div>

        @if ($products->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3>Belum Ada Produk</h3>
                <p>Silakan tambahkan produk pertama Anda</p>
                <a href="{{ route('admin.products.create') }}" class="btn-tambah">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Produk Pertama
                </a>
            </div>
        @else
            <div class="products-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}">
                            <span class="product-status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="product-content">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <div class="product-price-row">
                                <div class="product-price">
                                    @if ($product->old_price)
                                        <span class="old-price">Rp
                                            {{ number_format($product->old_price, 0, ',', '.') }}</span>
                                    @endif
                                    <span class="current-price">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                @if ($product->link)
                                    <a href="{{ $product->link }}" target="_blank" class="product-link-btn">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk \'{{ $product->name }}\'?')">
                                        <i class="fa-solid fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
@endsection
