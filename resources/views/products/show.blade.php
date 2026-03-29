@extends('layouts.landing')

@php
    $plainDescription = trim(strip_tags($product->description));
@endphp

@section('title', $product->name . ' - Detail Produk | Ar-Rahman E-Bike Bondowoso')
@section('meta_description', \Illuminate\Support\Str::limit($plainDescription, 155, '...'))
@section('meta_keywords', $product->name . ', detail produk sepeda listrik, harga ' . $product->name . ', Ar-Rahman E-Bike Bondowoso, sepeda listrik Bondowoso')

@push('styles')
    <style>
        .product-detail-hero {
            position: relative;
            padding: clamp(7.25rem, 10vw, 9rem) 0 clamp(2.6rem, 6vw, 4rem);
        }

        .product-detail-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(4, 11, 19, 0.18), rgba(4, 11, 19, 0.82)),
                var(--hero-background);
            background-size: cover;
            background-position: center;
        }

        .product-detail-hero .container {
            position: relative;
            z-index: 1;
        }

        .product-detail-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(280px, 0.95fr);
            gap: clamp(1.2rem, 3vw, 2rem);
            align-items: center;
        }

        .product-detail-copy {
            color: #fff;
        }

        .product-detail-copy h1 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(2.15rem, 5vw, 4.35rem);
            line-height: 1.04;
            margin: 0 0 0.9rem;
        }

        .product-detail-copy p {
            margin: 0;
            max-width: 620px;
            color: rgba(255, 255, 255, 0.82);
            font-size: clamp(0.96rem, 0.9rem + 0.2vw, 1.05rem);
            line-height: 1.8;
        }

        .product-detail-quick-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.4rem;
        }

        .product-detail-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.7rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .product-detail-pill i {
            color: #ffd37d;
        }

        .product-detail-visual {
            position: relative;
            min-height: clamp(320px, 44vw, 520px);
            border-radius: 32px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.24);
            box-shadow: 0 24px 60px rgba(7, 15, 25, 0.26);
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
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
            height: 32%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(4, 11, 19, 0.44));
        }

        .product-detail-section {
            margin-top: -1.2rem;
            position: relative;
            z-index: 2;
        }

        .product-description-copy {
            color: var(--text);
            line-height: 1.9;
            font-size: 0.98rem;
            white-space: pre-line;
        }

        .product-summary-card {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .product-summary-image-wrap {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(229, 57, 53, 0.08), rgba(245, 158, 11, 0.04));
        }

        .product-summary-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }

        .product-summary-meta {
            display: grid;
            gap: 0.85rem;
        }

        .product-summary-meta h2 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.4rem, 1.15rem + 0.9vw, 2rem);
            margin: 0;
        }

        .product-summary-status {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.6rem 0.85rem;
            border-radius: 999px;
            background: rgba(229, 57, 53, 0.08);
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.85rem;
            width: fit-content;
        }

        .product-summary-status i {
            color: var(--primary);
        }

        .product-summary-list {
            display: grid;
            gap: 0.9rem;
        }

        .product-summary-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            color: var(--muted);
            line-height: 1.75;
        }

        .product-summary-list i {
            color: var(--primary);
            font-size: 0.95rem;
            margin-top: 0.3rem;
        }

        .product-summary-actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.8rem;
            margin-top: auto;
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

        @media (max-width: 991.98px) {
            .product-detail-shell {
                grid-template-columns: 1fr;
            }

            .product-detail-visual {
                min-height: 280px;
            }
        }

        @media (max-width: 767.98px) {
            .product-detail-hero {
                padding-top: 6.65rem;
            }

            .product-detail-quick-meta {
                display: grid;
                grid-template-columns: 1fr;
            }

            .product-detail-section {
                margin-top: -0.6rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="product-detail-hero"
        style="--hero-background: url('{{ asset('uploads/products/' . $product->image) }}');">
        <div class="container">
            <div class="product-detail-shell">
                <div class="product-detail-copy">
                    <span class="eyebrow"><i class="fa-solid fa-bolt"></i>Detail Produk</span>
                    <h1>{{ $product->name }}</h1>
                    <p>{{ \Illuminate\Support\Str::limit($plainDescription, 220, '...') }}</p>

                    <div class="product-detail-quick-meta">
                        <span class="product-detail-pill">
                            <i class="fa-solid fa-tags"></i>
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @if ($product->old_price)
                            <span class="product-detail-pill">
                                <i class="fa-solid fa-percent"></i>
                                Harga normal Rp{{ number_format($product->old_price, 0, ',', '.') }}
                            </span>
                        @endif
                        <span class="product-detail-pill">
                            <i class="fa-solid {{ $product->link ? 'fa-link' : 'fa-message' }}"></i>
                            {{ $product->link ? 'Link pembelian tersedia' : 'Hubungi toko untuk pemesanan' }}
                        </span>
                    </div>

                    <div class="hero-actions">
                        @if ($product->link)
                            <a href="{{ route('products.click', $product) }}" target="_blank" rel="noopener"
                                class="btn btn-brand product-cta">
                                <i class="fa-solid fa-cart-shopping"></i>Beli Produk
                            </a>
                        @else
                            <button type="button" class="btn btn-brand product-unavailable-btn product-cta"
                                data-product-name="{{ $product->name }}"
                                data-track-url="{{ route('products.click', $product) }}">
                                <i class="fa-solid fa-cart-shopping"></i>Beli Produk
                            </button>
                        @endif
                        <a href="{{ route('home') }}#produk" class="btn btn-outline-light">
                            <i class="fa-solid fa-arrow-left"></i>Kembali ke Produk
                        </a>
                    </div>
                </div>

                <div class="product-detail-visual">
                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
            </div>
        </div>
    </section>

    <section class="section-space product-detail-section pt-0">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-12 col-lg-7">
                    <article class="contact-card h-100">
                        <span class="section-tag">Informasi Produk</span>
                        <h2>{{ $product->name }}</h2>
                        <div class="product-description-copy">{{ $plainDescription }}</div>
                    </article>
                </div>

                <div class="col-12 col-lg-5">
                    <aside class="map-card h-100 product-summary-card">
                        <div class="product-summary-image-wrap">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}"
                                class="product-summary-image">
                        </div>

                        <div class="product-summary-meta">
                            <span class="section-tag">Ringkasan</span>
                            <h2>Ringkasan Pembelian</h2>
                            <span class="product-summary-status">
                                <i class="fa-solid fa-circle-check"></i>
                                {{ $product->link ? 'Bisa dibeli online' : 'Konsultasi via toko' }}
                            </span>
                            <div class="price-wrap">
                                @if ($product->old_price)
                                    <span class="old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
                                @endif
                                <span class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <ul class="product-summary-list list-unstyled mb-0">
                            <li>
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Klik tombol beli untuk melanjutkan ke proses pemesanan atau cek ketersediaan link.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-tags"></i>
                                <span>{{ $product->old_price ? 'Harga promo dan harga normal ditampilkan agar perbandingan lebih jelas.' : 'Harga ditampilkan langsung agar calon pembeli bisa menilai unit dengan cepat.' }}</span>
                            </li>
                            <li>
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Butuh bantuan memilih unit? Tim toko siap membantu lewat WhatsApp dan kunjungan ke toko.</span>
                            </li>
                        </ul>

                        <div class="product-summary-actions">
                            @if ($product->link)
                                <a href="{{ route('products.click', $product) }}" target="_blank" rel="noopener"
                                    class="btn btn-brand product-cta">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
                                </a>
                            @else
                                <button type="button" class="btn btn-brand product-unavailable-btn product-cta"
                                    data-product-name="{{ $product->name }}"
                                    data-track-url="{{ route('products.click', $product) }}">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
                                </button>
                            @endif

                            <a href="https://wa.me/6285231260016?text=Halo%20saya%20ingin%20tanya%20tentang%20{{ urlencode($product->name) }}"
                                target="_blank" rel="noopener" class="btn btn-outline-dark">
                                <i class="fa-brands fa-whatsapp me-2"></i>Tanya via WhatsApp
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @if ($relatedProducts->isNotEmpty())
        <section class="section-space products-section pt-0">
            <div class="container">
                <div class="section-heading text-center">
                    <span class="section-tag">Produk Lainnya</span>
                    <h3>Model lain dengan tampilan dan pengalaman halaman yang sama</h3>
                    <p>Anda bisa membuka detail produk lain langsung dari card di bawah ini tanpa keluar dari gaya landing
                        page utama.</p>
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
