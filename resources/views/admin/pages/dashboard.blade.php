@extends('admin.layouts.main')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@push('styles')
    <style>
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 24px;
            padding: clamp(1.45rem, 2.6vw, 2rem);
            margin-bottom: 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .welcome-banner h2 {
            font-size: clamp(1.45rem, 1.2rem + 1vw, 1.9rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
            line-height: 1.2;
        }

        .welcome-banner p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .quick-actions {
            display: flex;
            gap: 0.9rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            padding: 0.75rem 1rem;
            border-radius: 14px;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            min-height: 48px;
        }

        .quick-action-btn:hover {
            background: #fff;
            color: var(--primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .stats-card {
            background: #fff;
            border-radius: 22px;
            padding: clamp(1.15rem, 2vw, 1.5rem);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: all 0.3s ease;
            min-height: 126px;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .stats-icon {
            width: 65px;
            height: 65px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stats-icon.primary {
            background: linear-gradient(135deg, rgba(230, 32, 38, 0.15) 0%, rgba(230, 32, 38, 0.05) 100%);
            color: var(--primary);
        }

        .stats-icon.success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(40, 167, 69, 0.05) 100%);
            color: var(--success);
        }

        .stats-info h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.25rem;
            color: var(--text);
            line-height: 1;
        }

        .stats-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .info-card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .info-card-header {
            padding: 1.2rem 1.35rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .info-card-header i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .info-card-header h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
        }

        .info-card-body {
            padding: clamp(1.15rem, 2vw, 1.5rem);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-item:first-child {
            padding-top: 0;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-content h4 {
            margin: 0 0 0.25rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
        }

        .info-content p {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        @media (max-width: 991.98px) {
            .quick-actions {
                gap: 0.8rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .welcome-banner {
                padding: 1.5rem;
            }

            .welcome-banner h2 {
                font-size: 1.5rem;
            }

            .quick-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .quick-action-btn {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stats-card {
                padding: 1.25rem;
            }

            .stats-icon {
                width: 55px;
                height: 55px;
                font-size: 1.25rem;
            }

            .stats-info h3 {
                font-size: 1.75rem;
            }

            .info-item {
                gap: 0.85rem;
            }
        }

        @media (max-width: 575.98px) {
            .welcome-banner {
                border-radius: 20px;
            }

            .info-card,
            .stats-card {
                border-radius: 20px;
            }
        }
    </style>
@endpush

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [['label' => 'Admin', 'url' => route('admin.dashboard')], ['label' => 'Dashboard']],
    ])

    <div class="welcome-banner">
        <h2>Selamat Datang, Admin!</h2>
        <p>Kelola website STAR SEPEDA LISTRIK dengan mudah</p>
        <div class="quick-actions">
            <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                <i class="fa-solid fa-plus"></i>
                Tambah Produk
            </a>
            <a href="{{ route('admin.products.index') }}" class="quick-action-btn">
                <i class="fa-solid fa-box"></i>
                Lihat Produk
            </a>
            <a href="{{ url('/') }}" target="_blank" class="quick-action-btn">
                <i class="fa-solid fa-eye"></i>
                Lihat Website
            </a>
        </div>
    </div>

    <div class="stats-grid mb-4">
        <div class="stats-card">
            <div class="stats-icon primary">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="stats-info">
                <h3>{{ $totalProducts }}</h3>
                <p>Total Produk</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon success">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="stats-info">
                <h3>{{ $activeProducts }}</h3>
                <p>Produk Aktif</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <i class="fa-solid fa-circle-info"></i>
                    <h3>Informasi Sistem</h3>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div class="info-content">
                            <h4>Admin Panel</h4>
                            <p>Kelola produk, lihat statistik, dan konfigurasi website dengan mudah.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="info-content">
                            <h4>Sepeda Listrik Bondowoso</h4>
                            <p>Website resmi penjualan sepeda listrik terpercaya di Bondowoso.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="info-content">
                            <h4>Keamanan</h4>
                            <p>Gunakan PIN dengan hati-hati. Default PIN: 1234</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="info-card h-100">
                <div class="info-card-header">
                    <i class="fa-solid fa-bolt"></i>
                    <h3>Quick Links</h3>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <div class="info-icon" style="background: var(--primary-light-alpha);">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="info-content">
                            <h4>Tambah Produk Baru</h4>
                            <p><a href="{{ route('admin.products.create') }}" class="text-decoration-none"
                                    style="color: var(--primary);">Klik di sini</a> untuk menambahkan produk
                                baru ke website.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"
                            style="background: var(--success-light-alpha); color: var(--success);">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="info-content">
                            <h4>Kelola Produk</h4>
                            <p><a href="{{ route('admin.products.index') }}" class="text-decoration-none"
                                    style="color: var(--primary);">Klik di sini</a> untuk melihat dan mengelola
                                semua produk.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon" style="background: var(--warning-light-alpha); color: var(--warning);">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="info-content">
                            <h4>Landing Page</h4>
                            <p><a href="{{ url('/') }}" target="_blank" class="text-decoration-none"
                                    style="color: var(--primary);">Klik di sini</a> untuk melihat tampilan
                                website publik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
