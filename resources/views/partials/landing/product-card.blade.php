@php
    $detailUrl = route('products.show', $product);
    $desc = \Illuminate\Support\Str::limit(trim(strip_tags($product->description)), 80, '...');
    $images = $product->images->count() > 0 ? $product->images : collect([ (object)['image_path' => $product->image] ]);
@endphp

<style>
    .product-image-slider {
        position: relative;
        width: 100%;
        height: clamp(230px, 28vw, 310px);
        overflow: hidden;
    }
    .slider-track {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease-in-out;
    }
    .slider-item {
        flex: 0 0 100%;
        width: 100%;
        height: 100%;
    }
    .slider-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .slider-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 5px;
        z-index: 2;
    }
    .slider-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }
    .slider-dot.active {
        background: #fff;
        width: 12px;
        border-radius: 10px;
    }
</style>

<article class="product-card h-100 is-clickable" data-product-url="{{ $detailUrl }}" tabindex="0" role="link"
    aria-label="Lihat detail produk {{ $product->name }}">
    <div class="product-image-wrap">
        <div class="product-image-slider" data-image-count="{{ $images->count() }}">
            <div class="slider-track">
                @foreach($images as $img)
                    <div class="slider-item">
                        <img src="{{ url('uploads/products/' . $img->image_path) }}" 
                             alt="Jual {{ $product->name }} Murah - Ar-Rahman E-Bike Bondowoso" 
                             loading="lazy"
                             width="400" 
                             height="400">
                    </div>
                @endforeach
            </div>
            @if($images->count() > 1)
                <div class="slider-dots">
                    @foreach($images as $index => $img)
                        <div class="slider-dot {{ $index === 0 ? 'active' : '' }}"></div>
                    @endforeach
                </div>
            @endif
        </div>
        <span class="product-badge">Lihat Detail</span>
    </div>
    <div class="product-body">
        <h3>{{ $product->name }}</h3>
        <p>{{ $desc }}</p>
        <div class="price-wrap">
            @if ($product->old_price)
                <span class="old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
            @endif
            <span class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
        </div>
        @if ($product->link)
            <a href="{{ route('products.click', $product) }}" target="_blank" rel="noopener"
                class="btn btn-brand w-100 product-cta">
                <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
            </a>
        @else
            <button type="button" class="btn btn-brand w-100 product-unavailable-btn product-cta"
                data-product-name="{{ $product->name }}" data-track-url="{{ route('products.click', $product) }}">
                <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
            </button>
        @endif
    </div>
</article>
