@extends('admin.layouts.main')

@section('title', 'Manajemen Produk - Admin')
@section('page-title', 'Manajemen Produk')

@push('styles')
    <style>
        .page-header {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.6rem;
            padding: 1.35rem 1.4rem;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: 0 18px 42px rgba(8, 19, 33, 0.08);
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            min-width: 0;
        }

        .page-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            box-shadow: 0 8px 24px rgba(255, 2, 5, 0.3);
            flex-shrink: 0;
        }

        .page-header-info {
            min-width: 0;
        }

        .page-header-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.38rem;
            margin-bottom: 0.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
        }

        .page-header-info h2 {
            margin: 0;
            font-size: clamp(1.38rem, 1.2rem + 0.8vw, 1.72rem);
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
        }

        .page-header-info .subtitle {
            font-size: 0.88rem;
            color: var(--muted);
            margin: 0.35rem 0 0;
            max-width: 540px;
            line-height: 1.6;
        }

        .page-header-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .page-header-chip {
            display: inline-flex;
            flex-direction: column;
            gap: 0.15rem;
            padding: 0.8rem 1rem;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(248, 251, 253, 0.92));
            border: 1px solid rgba(16, 33, 50, 0.08);
            min-width: 148px;
            box-shadow: 0 12px 26px rgba(8, 19, 33, 0.06);
        }

        .page-header-chip-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .page-header-chip-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-tambah-wrapper {
            display: flex;
            max-width: 100%;
        }

        .btn-tambah {
            position: relative;
            background: linear-gradient(135deg, var(--primary) 0%, #ff4d4d 100%);
            color: #fff;
            border: none;
            padding: 0;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(255, 2, 5, 0.35);
            overflow: hidden;
            min-height: 56px;
            max-width: 100%;
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(255, 2, 5, 0.45);
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
            align-items: center;
            padding: 0 1.25rem 0 0.75rem;
        }

        .btn-tambah-title {
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.2;
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

        .products-toolbar {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(280px, 0.95fr);
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: stretch;
        }

        .toolbar-card {
            min-width: 0;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: 0 18px 38px rgba(8, 19, 33, 0.06);
            padding: 1rem 1.05rem;
        }

        .toolbar-card-head {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            margin-bottom: 0.95rem;
        }

        .toolbar-card-kicker {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--primary);
        }

        .toolbar-card-caption {
            margin: 0;
            font-size: 0.82rem;
            color: var(--muted);
            line-height: 1.55;
        }

        .toolbar-search-form,
        .toolbar-filter-form {
            min-width: 0;
        }

        .toolbar-search-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 0.75rem;
            align-items: center;
        }

        .toolbar-filter-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 0.75rem;
            align-items: center;
        }

        .toolbar-search,
        .toolbar-filter {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .toolbar-input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            pointer-events: none;
            z-index: 2;
            font-size: 0.98rem;
        }

        .toolbar-search-control,
        .toolbar-filter-select {
            width: 100%;
            height: 56px;
            border-radius: var(--radius-md);
            border: 2px solid var(--line);
            background: #fff;
            box-shadow: 0 12px 26px rgba(8, 19, 33, 0.06);
            font-weight: 500;
            color: var(--text);
            transition: all 0.25s ease;
        }

        .toolbar-search-control {
            padding: 0.875rem 1.1rem 0.875rem 3.35rem;
        }

        .toolbar-filter-select {
            padding: 0.875rem 2.85rem 0.875rem 3.35rem;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--muted) 50%),
                linear-gradient(135deg, var(--muted) 50%, transparent 50%);
            background-position: calc(100% - 18px) calc(50% - 3px), calc(100% - 12px) calc(50% - 3px);
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat;
        }

        .toolbar-search:focus-within .toolbar-input-icon,
        .toolbar-filter:focus-within .toolbar-input-icon {
            color: var(--primary);
        }

        .toolbar-search-control:focus,
        .toolbar-filter-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light-alpha);
            outline: none;
        }

        .toolbar-search-btn {
            min-width: 118px;
            min-height: 56px;
            border-radius: 16px;
            font-weight: 600;
            box-shadow: 0 12px 28px rgba(255, 2, 5, 0.2);
        }

        .toolbar-reset-btn {
            min-width: 104px;
            min-height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.85rem 1rem;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 12px 26px rgba(8, 19, 33, 0.06);
            transition: all 0.2s ease;
        }

        .toolbar-reset-btn:hover {
            color: var(--text);
            border-color: rgba(16, 33, 50, 0.14);
            background: var(--bg-light);
        }

        .stat-card-mini {
            background: var(--surface-strong);
            border-radius: 18px;
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
            background: linear-gradient(135deg, rgba(255, 2, 5, 0.15), rgba(255, 2, 5, 0.05));
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

        .stat-icon.clicks {
            background: linear-gradient(135deg, rgba(255, 2, 5, 0.16), rgba(255, 77, 77, 0.08));
            color: var(--primary);
        }

        .stat-icon.unique {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.18), rgba(245, 158, 11, 0.08));
            color: var(--warning);
        }

        .stat-icon.interest {
            background: linear-gradient(135deg, rgba(16, 33, 50, 0.12), rgba(96, 112, 128, 0.06));
            color: var(--text);
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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            align-items: start;
        }

        .product-card {
            position: relative;
            background: var(--surface-strong);
            border-radius: 24px;
            box-shadow: 0 22px 52px rgba(8, 19, 33, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(16, 33, 50, 0.08);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-6px);
            border-color: rgba(255, 2, 5, 0.22);
            box-shadow: 0 26px 50px rgba(255, 2, 5, 0.14);
        }

        .product-image-container {
            position: relative;
            height: clamp(210px, 24vw, 236px);
            overflow: hidden;
        }

        .product-image-container::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 72px;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(8, 19, 33, 0.38));
            pointer-events: none;
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
            padding: 0.42rem 0.82rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
            box-shadow: 0 10px 24px rgba(8, 19, 33, 0.16);
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
            padding: 1.2rem 1.2rem 1.15rem;
            display: flex;
            flex-direction: column;
            gap: 0.95rem;
            flex: 1;
        }

        .product-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .product-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.38rem;
            padding: 0.42rem 0.72rem;
            border-radius: 999px;
            background: rgba(16, 33, 50, 0.05);
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 700;
            line-height: 1;
        }

        .product-meta-pill i {
            font-size: 0.72rem;
        }

        .product-meta-pill.promo {
            background: rgba(255, 2, 5, 0.1);
            color: var(--primary);
        }

        .product-meta-pill.analytics {
            background: rgba(245, 158, 11, 0.12);
            color: #b45309;
        }

        .product-meta-pill.interest {
            background: rgba(16, 33, 50, 0.06);
            color: var(--text);
        }

        .product-copy {
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
        }

        .product-content h3 {
            font-size: 1.04rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-content p {
            font-size: 0.82rem;
            color: var(--muted);
            margin: 0;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-insights-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .product-insight {
            padding: 0.78rem 0.85rem;
            border-radius: 16px;
            background: rgba(244, 248, 251, 0.95);
            border: 1px solid rgba(16, 33, 50, 0.06);
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            min-width: 0;
        }

        .product-insight span {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .product-insight strong {
            font-size: 0.86rem;
            color: var(--text);
            line-height: 1.35;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-top: auto;
            padding: 1rem 0 0;
            border-top: 1px solid rgba(16, 33, 50, 0.08);
        }

        .product-price {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.2rem;
            min-width: 0;
        }

        .current-price {
            font-size: 1.22rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.15;
        }

        .old-price {
            font-size: 0.78rem;
            color: var(--muted);
            text-decoration: line-through;
            line-height: 1.1;
        }

        .product-price-caption {
            font-size: 0.74rem;
            color: var(--muted);
            line-height: 1.45;
        }

        .product-link-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 2, 5, 0.08);
            border: 1px solid rgba(255, 2, 5, 0.12);
            border-radius: 12px;
            font-size: 0.82rem;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .product-link-btn:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .product-actions {
            display: flex;
            gap: 0.75rem;
            padding-top: 1rem;
            margin-top: 0.05rem;
        }

        .product-delete-form {
            flex: 1;
            display: flex;
        }

        .btn-action {
            flex: 1;
            min-height: 44px;
            padding: 0.75rem 0.85rem;
            border-radius: 14px;
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
            background: rgba(255, 2, 5, 0.09);
            color: var(--primary);
            border: 1px solid rgba(255, 2, 5, 0.12);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.12);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(255, 2, 5, 0.1) 0%, rgba(255, 2, 5, 0.05) 100%);
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

        @media (max-width: 991.98px) {
            .page-header {
                grid-template-columns: 1fr;
            }

            .page-header-right {
                justify-content: space-between;
            }

            .products-toolbar {
                grid-template-columns: 1fr;
            }

            .stats-row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                padding: 1.1rem;
            }

            .page-header-left {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                gap: 1rem;
            }

            .page-header-right {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-tambah {
                width: 100%;
                justify-content: flex-start;
            }

            .page-header-chip {
                width: 100%;
                min-width: 0;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .toolbar-search-form {
                grid-template-columns: 1fr;
            }

            .toolbar-filter-form {
                grid-template-columns: 1fr;
            }

            .toolbar-search-btn {
                width: 100%;
                min-height: 52px;
            }

            .toolbar-reset-btn {
                width: 100%;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .product-card {
                border-radius: 18px;
            }

            .product-insights-row {
                grid-template-columns: 1fr;
            }

            .product-price-row {
                align-items: flex-start;
            }
        }

        @media (max-width: 575.98px) {
            .page-header {
                border-radius: 20px;
            }

            .page-icon {
                width: 50px;
                height: 50px;
                border-radius: 14px;
            }

            .toolbar-card {
                padding: 0.9rem;
                border-radius: 20px;
            }

            .product-content {
                padding: 1rem;
            }

            .product-price-row {
                flex-wrap: wrap;
            }

            .product-actions {
                flex-direction: column;
            }

            .product-insight strong {
                white-space: normal;
            }

            .pagination-wrap .pagination {
                gap: 0.35rem;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Produk']],
    ])

    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="page-header-info">
                <span class="page-header-kicker">
                    <i class="fa-solid fa-layer-group"></i>
                    Katalog Admin
                </span>
                <h2>Manajemen Produk</h2>
                <p class="subtitle">Kelola produk, perbarui status, dan susun katalog Anda dengan tampilan yang lebih rapi di semua ukuran layar.</p>
            </div>
        </div>
        <div class="page-header-right">
            <div class="page-header-chip">
                <span class="page-header-chip-label">Total Produk</span>
                <span class="page-header-chip-value">{{ $productStats['total'] }} item</span>
            </div>
            <div class="btn-tambah-wrapper">
                <a href="{{ route('admin.products.create') }}" class="btn-tambah">
                    <div class="btn-tambah-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="btn-tambah-text">
                        <span class="btn-tambah-title">Tambah Produk</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="products-toolbar">
        <div class="toolbar-card">
            <div class="toolbar-card-head">
                <span class="toolbar-card-kicker">Pencarian</span>
                <p class="toolbar-card-caption">Temukan produk berdasarkan nama atau deskripsi tanpa harus membuka seluruh daftar.</p>
            </div>
            <form action="{{ route('admin.products.index') }}" method="GET" class="toolbar-search-form">
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="toolbar-search">
                    <span class="toolbar-input-icon" aria-hidden="true">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="search" class="form-control toolbar-search-control"
                        placeholder="Cari nama atau deskripsi produk..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary toolbar-search-btn">Cari</button>
            </form>
        </div>

        <div class="toolbar-card">
            <div class="toolbar-card-head">
                <span class="toolbar-card-kicker">Filter</span>
                <p class="toolbar-card-caption">Saring hasil berdasarkan status produk agar daftar lebih fokus dan mudah ditinjau.</p>
            </div>
            <form action="{{ route('admin.products.index') }}" method="GET" class="toolbar-filter-form">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <div class="toolbar-filter">
                    <span class="toolbar-input-icon" aria-hidden="true">
                        <i class="fa-solid fa-sliders"></i>
                    </span>
                    <select name="status" class="form-select toolbar-filter-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.products.index') }}" class="toolbar-reset-btn">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card-mini">
            <div class="stat-icon total">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $productStats['total'] }}</h4>
                <p>Total Produk</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon active">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $productStats['active'] }}</h4>
                <p>Produk Aktif</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon inactive">
                <i class="fa-solid fa-eye-slash"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $productStats['inactive'] }}</h4>
                <p>Produk Nonaktif</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon clicks">
                <i class="fa-solid fa-hand-pointer"></i>
            </div>
            <div class="stat-info">
                <h4>{{ number_format($productStats['total_clicks']) }}</h4>
                <p>Total Klik</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon unique">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <h4>{{ number_format($productStats['unique_clicks']) }}</h4>
                <p>Klik Unik</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon interest">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <div class="stat-info">
                <h4>{{ number_format($productStats['interest_clicks']) }}</h4>
                <p>Minat Tanpa Link</p>
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
                        <img src="/uploads/products/{{ $product->image }}" alt="{{ $product->name }}">
                        <span class="product-status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="product-content">
                        <div class="product-meta-row">
                            <span class="product-meta-pill">
                                <i class="fa-solid {{ $product->link ? 'fa-link' : 'fa-link-slash' }}"></i>
                                {{ $product->link ? 'Link tersedia' : 'Belum ada link' }}
                            </span>
                            <span class="product-meta-pill analytics">
                                <i class="fa-solid fa-hand-pointer"></i>
                                {{ number_format($product->click_count) }} klik
                            </span>
                            <span class="product-meta-pill analytics">
                                <i class="fa-solid fa-users"></i>
                                {{ number_format($product->unique_click_count) }} unik
                            </span>
                            @if ($product->interest_click_count > 0)
                                <span class="product-meta-pill interest">
                                    <i class="fa-solid fa-bell-concierge"></i>
                                    {{ number_format($product->interest_click_count) }} minat
                                </span>
                            @endif
                            @if ($product->old_price)
                                <span class="product-meta-pill promo">
                                    <i class="fa-solid fa-tag"></i>
                                    Diskon aktif
                                </span>
                            @endif
                        </div>

                        <div class="product-copy">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="product-insights-row">
                            <div class="product-insight">
                                <span>Minat Tanpa Link</span>
                                <strong>{{ number_format($product->interest_click_count) }} klik</strong>
                            </div>
                            <div class="product-insight">
                                <span>Klik Terakhir</span>
                                <strong>{{ $product->last_clicked_at ? $product->last_clicked_at->format('d M Y, H:i') : 'Belum ada klik' }}</strong>
                            </div>
                        </div>

                        <div class="product-price-row">
                            <div class="product-price">
                                @if ($product->old_price)
                                    <span class="old-price">Rp
                                        {{ number_format($product->old_price, 0, ',', '.') }}</span>
                                @endif
                                <span class="current-price">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="product-price-caption">
                                    {{ $product->link ? 'Tombol beli akan diarahkan ke link produk dan kliknya tercatat otomatis.' : 'Klik tanpa link tetap tercatat sebagai minat pembeli.' }}
                                </span>
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
                                class="product-delete-form" data-swal-confirm
                                data-confirm-title="Hapus produk ini?"
                                data-confirm-text="Produk {{ $product->name }} akan dihapus permanen."
                                data-confirm-button-text="Ya, hapus"
                                data-cancel-button-text="Batal"
                                data-confirm-icon="warning">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
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
@endsection
