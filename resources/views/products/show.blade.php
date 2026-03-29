@extends('layouts.landing')

@php
    $plainDescription = trim(strip_tags($product->description));

    $descriptionParagraphs = collect(preg_split('/\r\n|\r|\n/', $plainDescription))
        ->map(fn($paragraph) => trim($paragraph))
        ->filter()
        ->values();

    if ($descriptionParagraphs->isEmpty()) {
        $descriptionParagraphs = collect([$plainDescription]);
    }

    $hasDiscount = filled($product->old_price) && (float) $product->old_price > (float) $product->price;
    $discountAmount = $hasDiscount ? (float) $product->old_price - (float) $product->price : null;
    $discountPercent = $hasDiscount ? round(($discountAmount / (float) $product->old_price) * 100) : null;
    $ctaLabel = $product->link ? 'Langsung Beli Sekarang' : 'Cek Ketersediaan Produk';
    $statusLabel = $product->link ? 'Pembelian online tersedia' : 'Pemesanan melalui konsultasi toko';
    $statusCopy = $product->link
        ? 'Tautan pembelian aktif. Klik tombol beli untuk lanjut ke halaman checkout atau marketplace.'
        : 'Belum ada tautan pembelian langsung. Klik tombol beli untuk mengirim minat pembelian dan lanjut konsultasi.';
@endphp

@section('title', $product->name . ' - Detail Produk | Ar-Rahman E-Bike Bondowoso')
@section('meta_description', \Illuminate\Support\Str::limit($plainDescription, 155, '...'))
@section('meta_keywords', $product->name . ', detail produk sepeda listrik, harga ' . $product->name . ', Ar-Rahman E-Bike Bondowoso, sepeda listrik Bondowoso')

@push('styles')
    <style>
        .product-detail-hero {
            position: relative;
            padding: clamp(7.4rem, 11vw, 9.2rem) 0 clamp(3rem, 6vw, 4.8rem);
            overflow: clip;
        }

        .product-detail-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(6, 14, 26, 0.3), rgba(6, 14, 26, 0.84)),
                var(--hero-background);
            background-size: cover;
            background-position: center;
            transform: scale(1.03);
        }

        .product-detail-hero::after {
            content: "";
            position: absolute;
            inset: auto auto -140px -80px;
            width: clamp(240px, 34vw, 460px);
            height: clamp(240px, 34vw, 460px);
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.22), rgba(245, 158, 11, 0));
            pointer-events: none;
        }

        .product-detail-hero .container {
            position: relative;
            z-index: 1;
        }

        .product-detail-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.88rem;
        }

        .product-detail-breadcrumb a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }

        .product-detail-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(300px, 0.95fr);
            gap: clamp(1.4rem, 3vw, 2.4rem);
            align-items: center;
        }

        .product-detail-copy {
            color: #fff;
        }

        .product-detail-copy h1 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(2.4rem, 5vw, 4.7rem);
            line-height: 1.02;
            margin: 0 0 1rem;
            max-width: 11ch;
        }

        .product-detail-copy p {
            margin: 0;
            max-width: 620px;
            color: rgba(255, 255, 255, 0.84);
            font-size: clamp(0.98rem, 0.92rem + 0.22vw, 1.08rem);
            line-height: 1.82;
        }

        .product-detail-quick-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin: 1.4rem 0 0;
        }

        .product-detail-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.78rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.16);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 700;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .product-detail-pill i {
            color: #ffd37d;
        }

        .product-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.95rem;
            margin-top: 1.55rem;
        }

        .product-hero-stat {
            padding: 1rem 1rem 0.95rem;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .product-hero-stat span {
            display: block;
            color: rgba(255, 255, 255, 0.68);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.4rem;
            font-weight: 700;
        }

        .product-hero-stat strong {
            display: block;
            font-family: 'Sora', sans-serif;
            font-size: clamp(1rem, 0.92rem + 0.5vw, 1.35rem);
            line-height: 1.3;
        }

        .product-detail-visual {
            position: relative;
            min-height: clamp(380px, 48vw, 580px);
            border-radius: 34px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.24);
            box-shadow: 0 28px 80px rgba(7, 15, 25, 0.34);
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .product-detail-visual::before {
            content: "";
            position: absolute;
            inset: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 26px;
            z-index: 1;
            pointer-events: none;
        }

        .product-detail-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-detail-visual::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 42%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(4, 11, 19, 0.54));
        }

        .product-visual-floating-card {
            position: absolute;
            left: 1.35rem;
            right: 1.35rem;
            bottom: 1.35rem;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.05rem;
            border-radius: 24px;
            background: rgba(12, 22, 34, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .product-visual-floating-card span {
            display: block;
            color: rgba(255, 255, 255, 0.64);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .product-visual-floating-card strong {
            display: block;
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.2rem, 1.08rem + 0.55vw, 1.7rem);
            line-height: 1.2;
        }

        .product-floating-discount {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.72rem 0.9rem;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(255, 201, 71, 0.92));
            color: #3f2500;
            font-weight: 800;
            white-space: nowrap;
            box-shadow: 0 18px 30px rgba(245, 158, 11, 0.22);
        }

        .product-detail-section {
            margin-top: -1.6rem;
            position: relative;
            z-index: 2;
        }

        .product-detail-main {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
            gap: clamp(1.25rem, 2.6vw, 2rem);
            align-items: start;
        }

        .product-story-card,
        .product-buy-card,
        .product-insight-card {
            position: relative;
            overflow: hidden;
        }

        .product-story-card::before,
        .product-buy-card::before,
        .product-insight-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.26), rgba(255, 255, 255, 0));
            opacity: 0.5;
            pointer-events: none;
        }

        .product-story-head {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            padding-bottom: 1.15rem;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid rgba(16, 33, 50, 0.08);
        }

        .product-story-head h2,
        .product-buy-card h2,
        .product-insight-card h2 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.45rem, 1.18rem + 0.8vw, 2rem);
            margin: 0;
        }

        .product-story-head p,
        .product-buy-card p,
        .product-insight-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .product-story-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.95rem;
            margin-bottom: 1.4rem;
        }

        .product-story-metric {
            padding: 1rem 1rem 0.95rem;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(229, 57, 53, 0.08), rgba(245, 158, 11, 0.05));
            border: 1px solid rgba(229, 57, 53, 0.08);
        }

        .product-story-metric span {
            display: block;
            font-size: 0.78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
            margin-bottom: 0.45rem;
        }

        .product-story-metric strong {
            display: block;
            font-family: 'Sora', sans-serif;
            font-size: clamp(1rem, 0.94rem + 0.42vw, 1.28rem);
            line-height: 1.35;
            color: var(--text);
        }

        .product-description-copy {
            display: grid;
            gap: 1rem;
        }

        .product-description-copy p {
            color: var(--text);
            line-height: 1.95;
            font-size: 1rem;
            margin: 0;
        }

        .product-description-highlight {
            margin-top: 1.4rem;
            padding: 1.15rem 1.15rem 1.1rem;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(16, 33, 50, 0.04), rgba(229, 57, 53, 0.06));
            border: 1px solid rgba(16, 33, 50, 0.08);
        }

        .product-description-highlight strong {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 0.88rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--primary-dark);
            margin-bottom: 0.55rem;
        }

        .product-description-highlight p {
            margin: 0;
            color: var(--muted);
            line-height: 1.82;
        }

        .product-buy-card {
            position: sticky;
            top: 118px;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            padding-bottom: 1.3rem;
        }

        .product-buy-media {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            aspect-ratio: 1 / 1;
            background: linear-gradient(180deg, rgba(229, 57, 53, 0.08), rgba(245, 158, 11, 0.05));
        }

        .product-buy-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-buy-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.6rem 0.82rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.92);
            color: var(--text);
            font-size: 0.78rem;
            font-weight: 800;
            box-shadow: 0 16px 24px rgba(16, 33, 50, 0.12);
        }

        .product-buy-meta {
            display: grid;
            gap: 0.85rem;
        }

        .product-buy-status {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.7rem 0.95rem;
            border-radius: 999px;
            background: rgba(229, 57, 53, 0.08);
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.86rem;
            width: fit-content;
        }

        .product-buy-status i {
            color: var(--primary);
        }

        .product-price-panel {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1rem 0.95rem;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(229, 57, 53, 0.08), rgba(245, 158, 11, 0.08));
            border: 1px solid rgba(229, 57, 53, 0.08);
        }

        .product-price-caption {
            display: block;
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.7;
            max-width: 190px;
        }

        .product-price-panel .price-wrap {
            margin: 0;
        }

        .product-buy-list {
            display: grid;
            gap: 0.95rem;
            margin: 0;
        }

        .product-buy-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            color: var(--muted);
            line-height: 1.8;
        }

        .product-buy-list i {
            color: var(--primary);
            font-size: 0.95rem;
            margin-top: 0.28rem;
        }

        .product-summary-actions {
            display: grid;
            gap: 0.85rem;
            margin-top: 0.15rem;
        }

        .product-summary-actions .btn {
            width: 100%;
        }

        .product-summary-actions .btn-outline-dark {
            border-width: 1.5px;
            border-radius: 14px;
            font-weight: 700;
            min-height: 54px;
        }

        .product-insight-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .product-insight-mini {
            padding: 1rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.64);
            border: 1px solid rgba(16, 33, 50, 0.06);
        }

        .product-insight-mini i {
            color: var(--primary);
            font-size: 1rem;
            margin-bottom: 0.85rem;
        }

        .product-insight-mini strong {
            display: block;
            font-family: 'Sora', sans-serif;
            font-size: 1rem;
            margin-bottom: 0.4rem;
            color: var(--text);
        }

        .product-insight-mini p {
            font-size: 0.92rem;
            line-height: 1.75;
        }

        @media (max-width: 991.98px) {
            .product-detail-shell,
            .product-detail-main {
                grid-template-columns: 1fr;
            }

            .product-detail-copy h1 {
                max-width: none;
            }

            .product-detail-visual {
                min-height: 320px;
            }

            .product-buy-card {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .product-detail-hero {
                padding-top: 6.7rem;
            }

            .product-detail-breadcrumb {
                font-size: 0.82rem;
            }

            .product-detail-quick-meta,
            .product-hero-stats,
            .product-story-grid,
            .product-insight-grid {
                grid-template-columns: 1fr;
                display: grid;
            }

            .product-visual-floating-card,
            .product-price-panel,
            .product-story-head {
                display: grid;
            }

            .product-detail-section {
                margin-top: -0.85rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="product-detail-hero"
        style="--hero-background: url('{{ asset('uploads/products/' . $product->image) }}');">
        <div class="container">
            <div class="product-detail-breadcrumb">
                <a href="{{ route('home') }}#produk"><i class="fa-solid fa-arrow-left me-2"></i>Kembali ke katalog</a>
                <span>/</span>
                <span>{{ $product->name }}</span>
            </div>

            <div class="product-detail-shell">
                <div class="product-detail-copy">
                    <span class="eyebrow"><i class="fa-solid fa-bolt"></i>Detail Produk</span>
                    <h1>{{ $product->name }}</h1>
                    <p>{{ \Illuminate\Support\Str::limit($plainDescription, 240, '...') }}</p>

                    <div class="product-detail-quick-meta">
                        <span class="product-detail-pill">
                            <i class="fa-solid fa-tags"></i>
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @if ($hasDiscount)
                            <span class="product-detail-pill">
                                <i class="fa-solid fa-percent"></i>
                                Hemat Rp{{ number_format($discountAmount, 0, ',', '.') }}
                            </span>
                        @endif
                        <span class="product-detail-pill">
                            <i class="fa-solid {{ $product->link ? 'fa-link' : 'fa-message' }}"></i>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="product-hero-stats">
                        <div class="product-hero-stat">
                            <span>Harga Sekarang</span>
                            <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                        </div>
                        <div class="product-hero-stat">
                            <span>Status Beli</span>
                            <strong>{{ $product->link ? 'Bisa checkout online' : 'Hubungi toko dulu' }}</strong>
                        </div>
                        <div class="product-hero-stat">
                            <span>Dukungan</span>
                            <strong>Konsultasi cepat via WhatsApp</strong>
                        </div>
                    </div>

                    <div class="hero-actions">
                        @if ($product->link)
                            <a href="{{ route('products.click', $product) }}" target="_blank" rel="noopener"
                                class="btn btn-brand product-cta">
                                <i class="fa-solid fa-cart-shopping"></i>{{ $ctaLabel }}
                            </a>
                        @else
                            <button type="button" class="btn btn-brand product-unavailable-btn product-cta"
                                data-product-name="{{ $product->name }}"
                                data-track-url="{{ route('products.click', $product) }}">
                                <i class="fa-solid fa-cart-shopping"></i>{{ $ctaLabel }}
                            </button>
                        @endif
                        <a href="https://wa.me/6285231260016?text=Halo%20saya%20ingin%20tanya%20tentang%20{{ urlencode($product->name) }}"
                            target="_blank" rel="noopener" class="btn btn-outline-light">
                            <i class="fa-brands fa-whatsapp"></i>Konsultasi via WhatsApp
                        </a>
                    </div>
                </div>

                <div class="product-detail-visual">
                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-visual-floating-card">
                        <div>
                            <span>Harga Produk</span>
                            <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                        </div>
                        @if ($hasDiscount)
                            <div class="product-floating-discount">
                                <i class="fa-solid fa-bolt"></i>
                                Hemat {{ $discountPercent }}%
                            </div>
                        @else
                            <div class="product-floating-discount">
                                <i class="fa-solid fa-star"></i>
                                Ready untuk ditanyakan
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space product-detail-section pt-0">
        <div class="container">
            <div class="product-detail-main">
                <div class="d-grid gap-4">
                    <article class="contact-card product-story-card">
                        <div class="product-story-head">
                            <div>
                                <span class="section-tag">Informasi Produk</span>
                                <h2>{{ $product->name }}</h2>
                            </div>
                            <p>Susunan informasi dibuat lebih fokus agar calon pembeli bisa memahami nilai produk ini dengan cepat.</p>
                        </div>

                        <div class="product-story-grid">
                            <div class="product-story-metric">
                                <span>Harga aktif</span>
                                <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                            </div>
                            <div class="product-story-metric">
                                <span>{{ $hasDiscount ? 'Potongan harga' : 'Status pembelian' }}</span>
                                <strong>{{ $hasDiscount ? 'Hemat Rp' . number_format($discountAmount, 0, ',', '.') : $statusLabel }}</strong>
                            </div>
                        </div>

                        <div class="product-description-copy">
                            @foreach ($descriptionParagraphs as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <div class="product-description-highlight">
                            <strong><i class="fa-solid fa-circle-info"></i>Catatan Pembelian</strong>
                            <p>{{ $statusCopy }}</p>
                        </div>
                    </article>

                    <article class="map-card product-insight-card">
                        <span class="section-tag">Kenapa Menarik</span>
                        <h2>Informasi cepat yang paling sering dicari pembeli</h2>
                        <p>Tiga poin ini ditaruh terpisah agar halaman detail terasa lebih rapi dan keputusan pembelian lebih cepat.</p>

                        <div class="product-insight-grid">
                            <div class="product-insight-mini">
                                <i class="fa-solid fa-wallet"></i>
                                <strong>{{ $hasDiscount ? 'Harga lebih efisien' : 'Harga tampil jelas' }}</strong>
                                <p>{{ $hasDiscount ? 'Harga promo terlihat langsung bersama nominal penghematan.' : 'Calon pembeli bisa langsung melihat harga produk tanpa harus bertanya dulu.' }}</p>
                            </div>
                            <div class="product-insight-mini">
                                <i class="fa-solid fa-link"></i>
                                <strong>{{ $product->link ? 'Akses beli langsung' : 'Masih perlu konsultasi' }}</strong>
                                <p>{{ $product->link ? 'Tombol beli akan mengarah ke link produk aktif dengan tracking klik otomatis.' : 'Belum ada link langsung, tetapi minat pembeli tetap tercatat saat tombol ditekan.' }}</p>
                            </div>
                            <div class="product-insight-mini">
                                <i class="fa-brands fa-whatsapp"></i>
                                <strong>Dibantu tim toko</strong>
                                <p>Jika masih ragu soal stok atau model, calon pembeli bisa lanjut konsultasi lewat WhatsApp.</p>
                            </div>
                        </div>
                    </article>
                </div>

                <aside class="contact-card product-buy-card">
                    <div class="product-buy-media">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-summary-image">
                        <span class="product-buy-badge">
                            <i class="fa-solid fa-eye"></i>
                            Tampilan Produk
                        </span>
                    </div>

                    <div class="product-buy-meta">
                        <span class="section-tag">Ringkasan Pembelian</span>
                        <h2>Siap dilanjutkan ke tahap berikutnya</h2>
                        <p>Panel ini dirapikan khusus untuk menempatkan harga, status pembelian, dan CTA utama dalam satu area fokus.</p>
                        <span class="product-buy-status">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="product-price-panel">
                        <div class="price-wrap">
                            @if ($product->old_price)
                                <span class="old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
                            @endif
                            <span class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <span class="product-price-caption">
                            {{ $hasDiscount ? 'Harga lama tetap ditampilkan agar potongan lebih mudah dibandingkan.' : 'Harga utama ditampilkan dominan agar keputusan pembelian lebih cepat.' }}
                        </span>
                    </div>

                    <ul class="product-buy-list list-unstyled">
                        <li>
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $statusCopy }}</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-store"></i>
                            <span>Tersedia opsi konsultasi ke toko untuk cek stok, model, dan kecocokan kebutuhan harian.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-shield-heart"></i>
                            <span>Gaya tampilan halaman diselaraskan dengan landing page agar pengalaman pengguna tetap konsisten.</span>
                        </li>
                    </ul>

                    <div class="product-summary-actions">
                        @if ($product->link)
                            <a href="{{ route('products.click', $product) }}" target="_blank" rel="noopener"
                                class="btn btn-brand product-cta">
                                <i class="fa-solid fa-cart-shopping me-2"></i>{{ $ctaLabel }}
                            </a>
                        @else
                            <button type="button" class="btn btn-brand product-unavailable-btn product-cta"
                                data-product-name="{{ $product->name }}"
                                data-track-url="{{ route('products.click', $product) }}">
                                <i class="fa-solid fa-cart-shopping me-2"></i>{{ $ctaLabel }}
                            </button>
                        @endif

                        <a href="https://wa.me/6285231260016?text=Halo%20saya%20ingin%20tanya%20tentang%20{{ urlencode($product->name) }}"
                            target="_blank" rel="noopener" class="btn btn-outline-dark">
                            <i class="fa-brands fa-whatsapp me-2"></i>Tanya via WhatsApp
                        </a>
                        <a href="{{ route('home') }}#produk" class="btn btn-outline-dark">
                            <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke daftar produk
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if ($relatedProducts->isNotEmpty())
        <section class="section-space products-section pt-0">
            <div class="container">
                <div class="section-heading text-center">
                    <span class="section-tag">Produk Lainnya</span>
                    <h3>Masih ingin membandingkan model lain?</h3>
                    <p>Card di bawah tetap memakai UI yang sama seperti landing page, jadi pengunjung bisa pindah ke detail produk lain tanpa kehilangan konteks visual.</p>
                </div>

                <div class="row g-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-12 col-md-6 col-xl-3">
                            @include('partials.landing.product-card', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
