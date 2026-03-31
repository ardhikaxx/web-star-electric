@php
    $detailUrl = route('products.show', $product);
    $desc = \Illuminate\Support\Str::limit(trim(strip_tags($product->description)), 80, '...');
@endphp

<article class="product-card h-100 is-clickable" data-product-url="{{ $detailUrl }}" tabindex="0" role="link"
    aria-label="Lihat detail produk {{ $product->name }}">
    <div class="product-image-wrap">
        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Jual {{ $product->name }} Murah - Ar-Rahman E-Bike Bondowoso" class="product-image"
            loading="lazy">
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
