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
    $ctaLabel = $product->link ? 'Beli Sekarang' : 'Cek Stok';
    $statusLabel = $product->link ? 'Bisa Beli Online' : 'Hubungi Toko';
    
    $images = $product->images->count() > 0 ? $product->images : collect([ (object)['image_path' => $product->image] ]);
@endphp

@section('title', $product->name . ' - Detail Produk | Ar-Rahman E-Bike Bondowoso')
@section('meta_description', \Illuminate\Support\Str::limit($plainDescription, 155, '...'))

@push('styles')
    <style>
        .product-detail-hero {
            position: relative;
            padding: clamp(6rem, 10vw, 8rem) 0 clamp(2rem, 4vw, 3rem);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
        }

        .product-detail-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.88rem;
        }

        .product-detail-breadcrumb a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }

        .product-gallery-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .main-image-viewer {
            position: relative;
            width: 100%;
            aspect-ratio: 4/3;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: #fff;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .main-image-viewer img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: opacity 0.3s ease;
        }

        .thumbnail-strip {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            padding: 0.5rem 0.25rem 1rem;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .thumbnail-strip::-webkit-scrollbar {
            display: none;
        }

        .thumb-item {
            flex: 0 0 80px;
            aspect-ratio: 1/1;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .thumb-item.active {
            border-color: #ffca28;
            transform: translateY(-2px);
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info-panel {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .product-info-panel h1 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            margin: 0;
            line-height: 1.2;
            color: #fff;
        }

        .price-section {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-current-price {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
        }

        .detail-old-price {
            text-decoration: line-through;
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
        }

        .share-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-top: 1rem;
        }

        .share-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .share-btns {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-share {
            padding: 0.6rem 1.2rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s ease;
        }

        .btn-wa-share {
            background: #25d366;
            color: #fff;
            border: none;
        }

        .btn-copy-link {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .btn-share:hover {
            transform: translateY(-3px);
            opacity: 0.9;
        }

        .product-actions-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }

        @media (min-width: 768px) {
            .product-actions-grid {
                grid-template-columns: 1.2fr 1fr;
            }
        }

        .product-description-card {
            background: #fff;
            border-radius: 28px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid var(--line);
            margin-top: 2rem;
        }

        .description-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .description-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 4px;
        }

        .description-content p {
            line-height: 1.8;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .btn-modern-cta {
            min-height: 60px;
            font-size: 1.1rem;
            border-radius: 18px;
            width: 100%;
        }

        .btn-cta-buy {
            background: #fff !important;
            color: var(--primary) !important;
            border: 2px solid #fff !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .btn-cta-buy:hover {
            background: var(--bg) !important;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .btn-cta-whatsapp {
            background: #25d366 !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.2);
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            gap: 0.5rem; /* Reduced gap */
        }

        .btn-cta-whatsapp i {
            font-size: 1.5rem; /* Larger icon */
            margin: 0 !important; /* Remove bootstrap margin if any */
        }

        .btn-cta-whatsapp:hover {
            background: #1ebe5d !important;
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(37, 211, 102, 0.3);
        }
    </style>
@endpush

@section('content')
    <div class="product-detail-hero">
        <div class="container">
            <div class="product-detail-breadcrumb">
                <a href="{{ route('home') }}#produk"><i class="fa-solid fa-arrow-left me-2"></i>Katalog</a>
                <span>/</span>
                <span>{{ $product->name }}</span>
            </div>

            <div class="row g-5">
                <!-- Gallery Column -->
                <div class="col-12 col-lg-6">
                    <div class="product-gallery-container">
                        <div class="main-image-viewer">
                            <img src="{{ url('uploads/products/' . ($images[0]->image_path ?? $product->image)) }}" id="mainImage" alt="{{ $product->name }}">
                        </div>
                        
                        @if($images->count() > 1)
                        <div class="thumbnail-strip">
                            @foreach($images as $index => $img)
                                <div class="thumb-item {{ $index === 0 ? 'active' : '' }}" onclick="changeImage('{{ url('uploads/products/' . $img->image_path) }}', this)">
                                    <img src="{{ url('uploads/products/' . $img->image_path) }}" alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Info Column -->
                <div class="col-12 col-lg-6">
                    <div class="product-info-panel">
                        <span class="badge px-3 py-2 rounded-pill w-fit" style="width: fit-content; font-weight: 800; background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.2);">{{ $statusLabel }}</span>
                        <h1>{{ $product->name }}</h1>
                        
                        <div class="price-section">
                            @if ($product->old_price)
                                <span class="detail-old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
                            @endif
                            <div class="detail-current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>

                        <div class="product-actions-grid">
                            @if ($product->link)
                                <a href="{{ route('products.click', $product) }}" target="_blank" class="btn btn-brand btn-modern-cta btn-cta-buy">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>{{ $ctaLabel }}
                                </a>
                            @else
                                <button type="button" class="btn btn-brand btn-modern-cta btn-cta-buy product-unavailable-btn"
                                    data-product-name="{{ $product->name }}"
                                    data-track-url="{{ route('products.click', $product) }}">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>{{ $ctaLabel }}
                                </button>
                            @endif
                            
                            <a href="https://wa.me/6285231260016?text=Halo%20saya%20tertarik%20dengan%20{{ urlencode($product->name) }}%20yang%20ada%20di%20website..."
                                target="_blank" class="btn btn-modern-cta btn-cta-whatsapp">
                                <i class="fa-brands fa-whatsapp me-2"></i>Hubungi Admin
                            </a>
                        </div>

                        <div class="share-section">
                            <span class="share-label">Bagikan Produk</span>
                            <div class="share-btns">
                                <a href="https://wa.me/?text={{ urlencode($product->name . ' - ' . url()->current()) }}" target="_blank" class="btn btn-share btn-wa-share">
                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                </a>
                                <button type="button" class="btn btn-share btn-copy-link" id="copyLinkBtn">
                                    <i class="fa-solid fa-link"></i> Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="product-description-card">
            <h2 class="description-title">Deskripsi Produk</h2>
            <div class="description-content">
                @foreach ($descriptionParagraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>

        @if ($relatedProducts->isNotEmpty())
            <div class="mt-5 pt-4">
                <div class="section-heading">
                    <span class="section-tag">Rekomendasi</span>
                    <h3>Produk Lainnya</h3>
                </div>
                <div class="row g-4 mt-2">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-12 col-md-6 col-xl-3">
                            @include('partials.landing.product-card', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function changeImage(src, thumb) {
            const mainImg = document.getElementById('mainImage');
            mainImg.style.opacity = '0';
            
            setTimeout(() => {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 200);

            // Update active thumbnail
            document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
            thumb.classList.add('active');
        }

        document.getElementById('copyLinkBtn').addEventListener('click', function() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Link Berhasil Disalin',
                    text: 'Silakan bagikan link produk ini.',
                    timer: 2000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal-landing-popup'
                    }
                });
            });
        });
    </script>
@endpush
