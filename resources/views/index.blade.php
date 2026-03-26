@php
    $products = $products ?? collect();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Sepeda Listrik Bondowoso - STAR SEPEDA LISTRIK | Terpercaya & Termurah se-Jawa Timur</title>
    <meta name="description"
        content="Beli sepeda listrik terbaik di Bondowoso! STAR SEPEDA LISTRIK menawarkan harga promo, garansi resmi, layanan purna jual. Klik untuk melihat produk: urban, keluarga, harian!">
    <meta name="keywords"
        content="sepeda listrik, electric bike, e-bike, e-bike Bondowoso, Star Sepeda Listrik, jual sepeda listrik, beli sepeda listrik, harga sepeda listrik, promo sepeda listrik, sepeda listrik terbaik, toko sepeda listrik terpercaya, toko sepeda listrik terdekat, distributor sepeda listrik, agen sepeda listrik resmi, NUV Sepeda Listrik, Star Volt, Sepeda Listrik Urban, Sepeda Listrik Keluarga, Sepeda Listrik Harian, Sepeda Listrik Anak Sekolah, Sepeda Listrik Kerja Kantor, Sepeda Listrik Murah, Sepeda Listrik Promo, Sepeda Listrik Garansi, Sepeda Listrik Service, Sparepart Sepeda Listrik, Baterai Sepeda Listrik, Motor Listrik Sepeda, Kendaraan Hijau, Transportasi Ramah Lingkungan, Eco Friendly, Green Energy, Mobility Solution, Sepeda Listrik Jawa Timur, Toko Sepeda Listrik Jawa Timur, Harga Promo Sepeda Listrik, Best Seller Sepeda Listrik, Sepeda Listrik Modern, Sepeda Listrik Stylish, Sepeda Listrik Nyaman, Sepeda Listrik Irit, Sepeda Listrik Hemat, Sepeda Listrik Berkualitas, Sepeda Listrik Terpercaya Jawa Timur, Sepeda Listrik Termurah Jawa Timur, Jual Beli Sepeda Listrik Bondowoso, Toko Sepeda Listrik Bondowoso, Pusat Sepeda Listrik Bondowoso, Agen Resmi Sepeda Listrik Bondowoso">
    <meta name="author" content="STAR SEPEDA LISTRIK BONDOWOSO">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="revisit-after" content="7 days">
    <meta name="geo.region" content="ID-JI">
    <meta name="geo.placename" content="Bondowoso">
    <meta name="geo.position" content="-7.9220;113.8177">
    <meta name="ICBM" content="-7.9220, 113.8177">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --bg: #f4f8fb;
            --surface: rgba(255, 255, 255, 0.72);
            --surface-strong: #ffffff;
            --text: #102132;
            --muted: #607080;
            --primary: #FF0205;
            --primary-dark: #DA0003;
            --accent: #f59e0b;
            --line: rgba(16, 33, 50, 0.08);
            --shadow: 0 20px 60px rgba(8, 19, 33, 0.12);
            --radius-lg: 28px;
            --radius-md: 20px;
            --radius-sm: 16px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 2, 5, 0.14), transparent 28%),
                radial-gradient(circle at top right, rgba(245, 158, 11, 0.12), transparent 20%),
                linear-gradient(180deg, #f8fbfd 0%, #eef5f8 100%);
        }

        img {
            max-width: 100%;
            display: block;
        }

        .section-space {
            padding: 72px 0;
        }

        .section-heading {
            max-width: 640px;
            margin: 0 auto 2rem;
        }

        .section-heading h3,
        .contact-card h2 {
            font-family: 'Sora', sans-serif;
            line-height: 1.15;
            margin-bottom: 0.85rem;
        }

        .section-heading p,
        .hero-content p,
        .contact-card p,
        .site-footer p {
            color: var(--muted);
            font-size: 0.75rem;
            line-height: 1.75;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            background: var(--primary);
            border: 1px solid var(--primary);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .section-tag {
            margin-bottom: 1rem;
        }

        .navbar {
            padding-top: 0.9rem;
        }

        .navbar .container {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.42);
            box-shadow: 0 14px 40px rgba(16, 33, 50, 0.08);
            border-radius: 24px;
            padding: 0.75rem 1rem;
        }

        .navbar-brand {
            color: var(--text);
            font-weight: 800;
            text-decoration: none;
        }

        .navbar-brand span {
            display: inline-flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .navbar-brand small {
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 600;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), #ff4d4d);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .nav-link {
            color: var(--text);
            font-weight: 600;
        }

        .nav-link:hover,
        .nav-link:focus,
        .footer-links a:hover,
        .footer-links a:focus {
            color: var(--primary);
        }

        .navbar-toggler {
            border: 0;
            box-shadow: none !important;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--primary), #ff4d4d);
            border: 0;
            color: #fff;
            padding: 0.85rem 1.25rem;
            border-radius: 14px;
            font-weight: 700;
            box-shadow: 0 14px 30px rgba(255, 2, 5, 0.24);
        }

        .btn-brand:hover,
        .btn-brand:focus {
            color: #fff;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .hero-slide {
            min-height: 100vh;
            display: flex;
            align-items: flex-end;
            background-size: cover;
            background-position: center;
            padding: 7rem 0 4.5rem;
        }

        .hero-content {
            max-width: 640px;
            color: #fff;
        }

        .hero-content h1,
        .hero-content h2 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(2.2rem, 8vw, 4.8rem);
            line-height: 1.05;
            margin: 1rem 0;
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.82);
            max-width: 560px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            margin-top: 1.5rem;
        }

        .hero-actions .btn-outline-light {
            border-width: 1.5px;
            border-radius: 14px;
            padding: 0.85rem 1.25rem;
            font-weight: 700;
        }

        .hero-indicators {
            bottom: 2rem;
        }

        .hero-indicators button {
            width: 10px !important;
            height: 10px !important;
            border-radius: 50%;
        }

        .stats-section {
            position: relative;
            margin-top: -3rem;
            z-index: 2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card,
        .product-card,
        .testimonial-card,
        .contact-card,
        .map-card {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .stat-card {
            padding: 1.4rem;
        }

        .stat-card h3 {
            font-family: 'Sora', sans-serif;
            font-size: 1.4rem;
            margin-bottom: 0.35rem;
        }

        .stat-card p {
            margin-bottom: 0;
            color: var(--muted);
        }

        .products-section {
            position: relative;
        }

        .product-card {
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 55px rgba(16, 33, 50, 0.16);
        }

        .empty-products-card {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 3rem 2rem;
            text-align: center;
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon-wrap {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(255, 2, 5, 0.15), rgba(255, 2, 5, 0.05));
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            color: var(--primary);
        }

        .empty-products-card h3 {
            font-family: 'Sora', sans-serif;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            color: var(--text);
        }

        .empty-products-card p {
            color: var(--muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .empty-products-card .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.875rem 1.75rem;
            font-weight: 600;
            border-radius: 12px;
            box-shadow: 0 14px 30px rgba(255, 2, 5, 0.24);
            transition: all 0.3s ease;
        }

        .empty-products-card .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(255, 2, 5, 0.32);
        }

        .product-image-wrap {
            position: relative;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 0.8rem;
            background: rgba(255, 255, 255, 0.92);
            color: var(--text);
            border-radius: 999px;
            font-size: 0.74rem;
            font-weight: 800;
        }

        .product-badge.alt {
            background: rgba(245, 158, 11, 0.92);
            color: #fff;
        }

        .product-body {
            padding: 1.25rem;
        }

        .product-body h3,
        .testimonial-card h3,
        .site-footer h3 {
            font-family: 'Sora', sans-serif;
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
        }

        .product-body p {
            color: var(--muted);
            min-height: 78px;
        }

        .price-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1rem 0 1.2rem;
            flex-wrap: wrap;
        }

        .current-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .old-price {
            color: #9aa8b4;
            text-decoration: line-through;
            font-weight: 700;
        }

        .testimonial-section {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, rgba(255, 2, 5, 0.06), rgba(245, 158, 11, 0.02));
        }

        .testimonial-card {
            padding: 2rem 1.5rem;
            text-align: center;
            max-width: 760px;
            margin: 0 auto;
        }

        .testimonial-card p {
            font-size: 1.06rem;
            line-height: 1.85;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .testimonial-card span {
            color: var(--muted);
        }

        .quote-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            border-radius: 20px;
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            color: #fff;
            background: linear-gradient(135deg, #f59e0b, #ffbf47);
        }

        .testimonial-controls {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .control-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #fff;
            color: var(--text);
            box-shadow: 0 12px 28px rgba(16, 33, 50, 0.12);
        }

        .contact-card,
        .map-card {
            padding: 1.5rem;
            height: 100%;
        }

        .contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.9rem;
            padding: 0.9rem 0;
            border-bottom: 1px solid var(--line);
        }

        .contact-list li:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .contact-list i {
            color: var(--primary);
            font-size: 1.05rem;
            margin-top: 0.25rem;
        }

        .contact-list a,
        .footer-links a,
        .footer-brand {
            color: var(--text);
            text-decoration: none;
        }

        .store-item {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            border-bottom: 1px solid #e8e8e8;
        }

        .store-item:last-of-type {
            border-bottom: none;
        }

        .store-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--primary);
            margin-bottom: -4px;
            letter-spacing: 0.3px;
        }

        .store-name i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .store-address {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            padding-left: 0;
        }

        .store-address i {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .store-address span {
            font-size: 0.82rem;
            color: #666;
            line-height: 1.5;
        }

        .map-card iframe {
            width: 100%;
            height: 100%;
            min-height: 340px;
            border: 0;
            border-radius: 22px;
        }

        .site-footer {
            padding: 2rem 0 1.2rem;
            background: #0e1f2a;
            color: rgba(255, 255, 255, 0.82);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.8rem;
        }

        .footer-brand {
            display: inline-block;
            font-family: 'Sora', sans-serif;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 0.85rem;
        }

        .site-footer h3 {
            color: #fff;
        }

        .footer-links {
            display: grid;
            gap: 0.65rem;
            margin: 0;
        }

        .footer-links a,
        .footer-links span {
            color: rgba(255, 255, 255, 0.74);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
            padding-top: 1.2rem;
            text-align: center;
        }

        @media (min-width: 576px) {
            .product-image {
                height: 280px;
            }
        }

        @media (min-width: 768px) {

            .stats-grid,
            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .hero-slide {
                align-items: center;
                padding: 8.5rem 0 6rem;
            }

            .stat-card {
                padding: 1.6rem;
            }

            .contact-card,
            .map-card,
            .testimonial-card {
                padding: 2rem;
            }
        }

        @media (min-width: 992px) {
            .navbar .container {
                padding-left: 1.35rem;
                padding-right: 1.35rem;
            }

            .navbar-collapse {
                flex-grow: 0;
            }

            .hero-content p {
                font-size: 1.05rem;
            }

            .section-space {
                padding: 96px 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#home">
                <img src="{{ asset('assets/logo.png') }}" alt="STAR SEPEDA LISTRIK" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-3 mb-lg-0 align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-brand" href="https://wa.me/6281331978800"
                            target="_blank" rel="noopener">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section id="home" class="hero-section">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4500">
                <div class="carousel-indicators hero-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="hero-slide"
                            style="background-image: linear-gradient(180deg, rgba(4,11,19,.12), rgba(4,11,19,0.9)), url('https://nuv.co.id/storage/app/vehicle/20250728000101Product%20highlight-05.jpg');">
                            <div class="container">
                                <div class="hero-content">
                                    <h1>Jelajahi kota dengan sepeda listrik yang hemat dan nyaman.</h1>
                                    <p>STAR SEPEDA LISTRIK BONDOWOSO menghadirkan pilihan sepeda listrik untuk mobilitas
                                        harian, usaha, hingga gaya hidup modern.</p>
                                    <div class="hero-actions">
                                        <a href="#produk" class="btn btn-brand">Lihat Produk</a>
                                        <a href="#kontak" class="btn btn-outline-light">Kunjungi Toko</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="hero-slide"
                            style="background-image: linear-gradient(180deg, rgba(4,11,19,.12), rgba(4,11,19,0.9)), url('https://nuv.co.id/storage/app/vehicle/20250727235527Product%20highlight-02.jpg');">
                            <div class="container">
                                <div class="hero-content">
                                    <h2>Harga lebih menarik dengan performa baterai yang tahan lama.</h2>
                                    <p>Dapatkan penawaran terbaik untuk berbagai model sepeda listrik dengan desain
                                        elegan dan fitur kekinian.</p>
                                    <div class="hero-actions">
                                        <a href="https://wa.me/6281331978800" class="btn btn-brand" target="_blank"
                                            rel="noopener">Pesan via WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="hero-slide"
                            style="background-image: linear-gradient(180deg, rgba(4,11,19,.12), rgba(4,11,19,0.9)), url('https://nuv.co.id/storage/app/vehicle/20260303095623NUV%20S7%20-%20VERITON-2.jpg');">
                            <div class="container">
                                <div class="hero-content">
                                    <h2>Temukan kendaraan ringkas untuk sekolah, kerja, dan kebutuhan keluarga.</h2>
                                    <p>Unit pilihan dengan tampilan modern, efisien, dan siap mendukung aktivitas Anda
                                        setiap hari.</p>
                                    <div class="hero-actions">
                                        <a href="#testimoni" class="btn btn-outline-light">Lihat Testimoni</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>100+</h3>
                        <p>Pelanggan puas memilih sepeda listrik untuk kebutuhan harian.</p>
                    </div>
                    <div class="stat-card">
                        <h3>6+</h3>
                        <p>Model favorit dengan gaya berbeda untuk berbagai usia.</p>
                    </div>
                    <div class="stat-card">
                        <h3>Fast Respon</h3>
                        <p>Konsultasi cepat melalui WhatsApp untuk cek stok dan promo.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="section-space products-section">
            <div class="container">
                <div class="section-heading text-center">
                    <span class="section-tag">Produk Pilihan</span>
                    <h3>Model sepeda listrik yang siap menunjang mobilitas Anda</h3>
                    <p>Pilih unit favorit dengan desain modern, fitur nyaman, dan <a href="#testimoni">harga promo</a>
                        yang lebih menarik. Lihat juga <a href="#kontak">layanan purna jual</a> kami!</p>
                </div>
                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-12 col-md-6 col-xl-3">
                            <article class="product-card h-100">
                                <div class="product-image-wrap">
                                    <img src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="{{ $product->name }}" class="product-image">
                                </div>
                                <div class="product-body">
                                    <h3>{{ $product->name }}</h3>
                                    @php
                                        $desc = strip_tags($product->description);
                                        $desc = strlen($desc) > 80 ? substr($desc, 0, 80) . '...' : $desc;
                                    @endphp
                                    <p>{{ $desc }}</p>
                                    <div class="price-wrap">
                                        <span
                                            class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                        @if ($product->old_price)
                                            <span
                                                class="old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ $product->link ? $product->link : 'https://wa.me/6281234567890?text=Halo%20saya%20ingin%20beli%20' . urlencode($product->name) }}"
                                        target="_blank" rel="noopener" class="btn btn-brand w-100">
                                        <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
                                    </a>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-products-card">
                                <div class="empty-icon-wrap">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h3>Produk Sementara Tidak Tersedia</h3>
                                <p>Kami sedang memperbarui koleksi produk terbaru untuk Anda. Silakan hubungi kami untuk informasi produk terkini.</p>
                                <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20tanya%20tentang%20produk%20sepeda%20listrik" 
                                   target="_blank" 
                                   class="btn btn-brand">
                                    <i class="fa-brands fa-whatsapp me-2"></i>
                                    Hubungi via WhatsApp
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="testimoni" class="section-space testimonial-section">
            <div class="container">
                <div class="section-heading text-center">
                    <span class="section-tag">Testimoni</span>
                    <h3>Apa kata pelanggan STAR SEPEDA LISTRIK BONDOWOSO</h3>
                    <p>Beberapa pengalaman pelanggan setelah menggunakan sepeda listrik dari toko kami.</p>
                </div>
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="3500">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="fa-solid fa-quote-right"></i></div>
                                <p>Pelayanannya ramah, unitnya bagus, dan cocok dipakai harian ke kantor. Irit dan
                                    nyaman sekali.</p>
                                <h3>Rina Permata</h3>
                                <span>Pelanggan Bondowoso</span>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="fa-solid fa-quote-right"></i></div>
                                <p>Banyak pilihan model, harganya masuk akal, dan toko cepat respon waktu saya tanya
                                    lewat WhatsApp.</p>
                                <h3>Andi Saputra</h3>
                                <span>Pembeli Star Volt X</span>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="fa-solid fa-quote-right"></i></div>
                                <p>Saya pilih model keluarga, ternyata nyaman dipakai antar anak sekolah. Recommended
                                    untuk yang cari sepeda listrik.</p>
                                <h3>Dewi Lestari</h3>
                                <span>Pelanggan Setia</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-controls">
                        <button class="carousel-control-prev position-static" type="button"
                            data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="control-btn"><i class="fa-solid fa-arrow-left"></i></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next position-static" type="button"
                            data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="control-btn"><i class="fa-solid fa-arrow-right"></i></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="section-space contact-section">
            <div class="container">
                <div class="row g-4 align-items-stretch">
                    <div class="col-12 col-lg-5">
                        <div class="contact-card h-100">
                            <span class="section-tag">Kontak & Lokasi</span>
                            <h2>Kunjungi toko kami di Bondowoso</h2>
                            <p>Datang langsung untuk melihat unit, cek promo, dan konsultasi model sepeda listrik yang
                                paling sesuai dengan kebutuhan Anda.</p>
                            <ul class="contact-list list-unstyled mb-0">
                                <li class="store-item">
                                    <div class="store-name">
                                        <i class="fa-solid fa-store"></i>
                                        STAR SEPEDA LISTRIK
                                    </div>
                                    <div class="store-address">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>Jl. Ahmad Yani No.89, Penatu, Badean, Kec. Bondowoso, Kabupaten Bondowoso,
                                            Jawa Timur 68214</span>
                                    </div>
                                </li>
                                <li class="store-item">
                                    <div class="store-name">
                                        <i class="fa-solid fa-store"></i>
                                        ARRAHMAN E-BIKE BONDOWOSO
                                    </div>
                                    <div class="store-address">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>Depan Dinas Pengairan, Jl. Ahmad Yani No.89, Penatu, Badean, Kec.
                                            Bondowoso, Kabupaten Bondowoso, Jawa Timur 68214</span>
                                    </div>
                                </li>
                                <li class="store-item">
                                    <div class="store-name">
                                        <i class="fa-solid fa-store"></i>
                                        CABANG ARRAHMAN E-BIKE
                                    </div>
                                    <div class="store-address">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>Jl. Raya Pakisan, Krasak, Maskuning Kulon, Kec. Pujer, Kabupaten
                                            Bondowoso, Jawa Timur 67281</span>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <a href="tel:+6281331978800">+62 813-3197-8800</a>
                                </li>
                                <li>
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <a href="https://wa.me/6281331978800" target="_blank" rel="noopener">Chat
                                        WhatsApp Sekarang</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Siap melayani konsultasi pembelian dan info stok produk.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="map-card h-100">
                            <iframe title="Lokasi STAR SEPEDA LISTRIK BONDOWOSO"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.741758460526!2d113.81527601072808!3d-7.9220198788369105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6dd5a2b77ad85%3A0xb9c33635d00b3d8e!2sARRAHMAN%20E-BIKE%20BONDOWOSO!5e0!3m2!1sid!2sid!4v1774357546917!5m2!1sid!2sid"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a class="footer-brand" href="#home">
                        <img src="{{ asset('assets/logo.png') }}" alt="STAR SEPEDA LISTRIK" style="height: 40px;">
                    </a>
                    <p>Pusat penjualan sepeda listrik di Bondowoso dengan pilihan model modern, nyaman, dan siap pakai
                        untuk aktivitas sehari-hari.</p>
                </div>
                <div>
                    <h3>Navigasi</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#produk">Produk</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Kontak</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="tel:+6281331978800">+62 813-3197-8800</a></li>
                        <li><a href="https://wa.me/6281331978800" target="_blank" rel="noopener">WhatsApp</a></li>
                        <li><span>Bondowoso, Jawa Timur</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 STAR SEPEDA LISTRIK BONDOWOSO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                    history.replaceState(null, null, ' ');
                }
            });
        });
    </script>
</body>

</html>
