{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <priority>1.0</priority>
    </url>
    @foreach ($products as $product)
    <url>
        <loc>{{ route('products.show', $product) }}</loc>
        <priority>0.8</priority>
    </url>
    @endforeach
</urlset>
