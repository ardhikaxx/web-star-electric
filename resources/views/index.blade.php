@php
    $products = $products ?? collect();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sepeda Listrik Bondowoso - Ar-Rahman E-Bike Bondowoso | Spesialis Sepeda Listrik Jawa Timur</title>
    <meta name="description"
        content="Toko spesialis sepeda listrik yang melayani kebutuhan pelanggan di seluruh Jawa Timur. Kami menyediakan berbagai pilihan sepeda listrik dari berbagai merk ternama, serta menjual beragam perlengkapan pendukung seperti sparepart, karpet sepeda listrik, baterai, dan charger baterai sepeda listrik. Dengan harga yang bersaing dan kualitas terjamin, StarBWS hadir sebagai solusi terpercaya untuk Anda yang mencari produk sepeda listrik dengan harga termurah di Jawa Timur.">
    <meta name="keywords"
        content="sepeda listrik, electric bike, e-bike, e-bike Bondowoso, Star Sepeda Listrik, StarBWS, jual sepeda listrik, beli sepeda listrik, harga sepeda listrik, promo sepeda listrik, sepeda listrik terbaik, toko sepeda listrik terpercaya, toko sepeda listrik terdekat, distributor sepeda listrik, agen sepeda listrik resmi, NUV Sepeda Listrik, Star Volt, Sepeda Listrik Urban, Sepeda Listrik Keluarga, Sepeda Listrik Harian, Sepeda Listrik Anak Sekolah, Sepeda Listrik Kerja Kantor, Sepeda Listrik Murah, Sepeda Listrik Promo, Sepeda Listrik Garansi, Sepeda Listrik Service, Sparepart Sepeda Listrik, Karpet Sepeda Listrik, Baterai Sepeda Listrik, Charger Sepeda Listrik, Motor Listrik Sepeda, Kendaraan Hijau, Transportasi Ramah Lingkungan, Eco Friendly, Green Energy, Mobility Solution, Sepeda Listrik Jawa Timur, Toko Sepeda Listrik Jawa Timur, Harga Promo Sepeda Listrik, Best Seller Sepeda Listrik, Sepeda Listrik Modern, Sepeda Listrik Stylish, Sepeda Listrik Nyaman, Sepeda Listrik Irit, Sepeda Listrik Hemat, Sepeda Listrik Berkualitas, Sepeda Listrik Terpercaya Jawa Timur, Sepeda Listrik Termurah Jawa Timur, Jual Beli Sepeda Listrik Bondowoso, Toko Sepeda Listrik Bondowoso, Pusat Sepeda Listrik Bondowoso, Agen Resmi Sepeda Listrik Bondowoso, Sepeda Listrik Sport, Sepeda Listrik Foldable, Sepeda Listrik Battery, Sepeda Listrik Charging, Sepeda Listrik Garansi Resmi, Service Center Sepeda Listrik, Aksesoris Sepeda Listrik, Helm Sepeda Listrik, Locks Sepeda Listrik, Spesialis Sepeda Listrik, Toko Sepeda Listrik Terbaik, Sepeda Listrik Termurah, Grosir Sepeda Listrik, Retail Sepeda Listrik, Electric Vehicle, E-Vehicle, Sustainable Transport, Sepeda Listrik Indonesia, Merk Sepeda Listrik, Vintage Sepeda Listrik, Premium Sepeda Listrik, Affordable E-Bike, Cheap E-Bike, Quality E-Bike, Trusted E-Bike Shop, E-Bike Bondowoso, E-Bike Store East Java, Electric Scooter, Electric Motorcycle, Sepeda Listrik Custom, Modifikasi Sepeda Listrik, Perbaikan Sepeda Listrik, Servis Sepeda Listrik, Rental Sepeda Listrik">
    <meta name="author" content="Ar-Rahman E-Bike Bondowoso">
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
            --primary: #E53935;
            --primary-dark: #B71C1C;
            --accent: #f59e0b;
            --line: rgba(16, 33, 50, 0.08);
            --shadow: 0 20px 60px rgba(8, 19, 33, 0.12);
            --radius-lg: 28px;
            --radius-md: 20px;
            --radius-sm: 16px;
            --container-max: 1220px;
            --container-pad: clamp(1rem, 2.2vw, 1.5rem);
            --section-pad: clamp(4rem, 8vw, 6rem);
            --hero-min-height: clamp(620px, 92svh, 920px);
            --nav-offset: 96px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: calc(var(--nav-offset) + 18px);
            overflow-x: hidden;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 2, 5, 0.14), transparent 28%),
                radial-gradient(circle at top right, rgba(245, 158, 11, 0.12), transparent 20%),
                linear-gradient(180deg, #f8fbfd 0%, #eef5f8 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        a,
        button {
            transition: color 0.2s ease, background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            width: min(calc(100% - (var(--container-pad) * 2)), var(--container-max));
            max-width: none;
            padding-left: 0;
            padding-right: 0;
        }

        .section-space {
            padding: var(--section-pad) 0;
        }

        .section-heading {
            max-width: 760px;
            margin: 0 auto clamp(1.85rem, 4vw, 3rem);
        }

        .section-heading h3,
        .contact-card h2 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.7rem, 1.25rem + 1.45vw, 2.65rem);
            line-height: 1.15;
            margin-bottom: 0.85rem;
        }

        .section-heading p,
        .hero-content p,
        .contact-card p,
        .site-footer p {
            color: var(--muted);
            font-size: clamp(0.94rem, 0.88rem + 0.15vw, 1rem);
            line-height: 1.75;
        }

        .section-tag,
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .section-tag {
            background: var(--primary);
            border: 1px solid var(--primary);
            color: #fff;
            margin-bottom: 1rem;
        }

        .eyebrow {
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .navbar {
            padding: 0.85rem 0 0;
        }

        .navbar .container {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.42);
            box-shadow: 0 14px 40px rgba(16, 33, 50, 0.08);
            border-radius: 24px;
            padding: 0.75rem 0.9rem;
        }

        .navbar-brand {
            text-decoration: none;
            margin: 0;
            padding: 0;
            flex-shrink: 0;
        }

        .navbar-logo {
            height: clamp(58px, 7vw, 84px);
            width: auto;
            margin-top: -25px;
            margin-bottom: -25px;
        }

        .nav-link {
            color: var(--text);
            font-weight: 600;
            padding: 0.75rem 1rem !important;
            border-radius: 14px;
        }

        .nav-link:hover,
        .nav-link:focus,
        .footer-links a:hover,
        .footer-links a:focus {
            color: var(--primary);
        }

        .navbar-toggler {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 1px solid rgba(16, 33, 50, 0.1);
            border-radius: 14px;
            background: #fff;
            box-shadow: none !important;
        }

        .navbar-toggler-icon {
            width: 1.2rem;
            height: 1.2rem;
        }

        .btn-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary), #ff4d4d);
            border: 0;
            color: #fff;
            padding: 0.85rem 1.25rem;
            border-radius: 14px;
            font-weight: 700;
            min-height: 54px;
            box-shadow: 0 14px 30px rgba(255, 2, 5, 0.24);
        }

        .btn-brand:hover,
        .btn-brand:focus {
            color: #fff;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .hero-section {
            position: relative;
        }

        .hero-slide {
            min-height: var(--hero-min-height);
            display: flex;
            align-items: flex-end;
            background-size: cover;
            background-position: center;
            padding: clamp(6.5rem, 11vw, 8rem) 0 clamp(3.8rem, 7vw, 5.5rem);
        }

        .hero-slide .container {
            display: flex;
            align-items: flex-end;
        }

        .hero-content {
            max-width: min(680px, 100%);
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
            margin-bottom: 0;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            margin-top: 1.7rem;
        }

        .hero-actions .btn-brand,
        .hero-actions .btn-outline-light {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-width: 1.5px;
            border-radius: 14px;
            padding: 0.85rem 1.25rem;
            font-weight: 700;
            min-height: 54px;
            min-width: 180px;
        }

        .hero-indicators {
            bottom: clamp(1.25rem, 3vw, 2rem);
        }

        .hero-indicators button {
            width: 10px !important;
            height: 10px !important;
            border-radius: 50%;
        }

        .stats-section {
            position: relative;
            margin-top: clamp(-2.25rem, -3vw, -3.25rem);
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
            padding: clamp(1.25rem, 2vw, 1.6rem);
            min-height: 148px;
        }

        .stat-card h3 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.45rem, 1.15rem + 0.95vw, 2rem);
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
            height: 100%;
            display: flex;
            flex-direction: column;
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
            flex-shrink: 0;
        }

        .product-image {
            width: 100%;
            height: clamp(230px, 28vw, 310px);
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
            padding: clamp(1.1rem, 1.8vw, 1.35rem);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1 1 auto;
        }

        .product-body h3,
        .testimonial-card h3,
        .site-footer h3 {
            font-family: 'Sora', sans-serif;
            font-size: 1.15rem;
            margin-bottom: 0;
        }

        .product-body p {
            color: var(--muted);
            min-height: 0;
            margin-bottom: 0;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-body .btn-brand {
            width: 100%;
            margin-top: auto;
        }

        .price-wrap {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
            margin: 0.1rem 0 0;
        }

        .current-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1.2;
        }

        .old-price {
            color: #9aa8b4;
            text-decoration: line-through;
            font-weight: 700;
            font-size: 0.82rem;
            line-height: 1.2;
        }

        .testimonial-section {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, rgba(255, 2, 5, 0.06), rgba(245, 158, 11, 0.02));
        }

        .testimonial-card {
            padding: clamp(1.5rem, 3vw, 2.2rem);
            text-align: center;
            max-width: 760px;
            margin: 0 auto;
        }

        .testimonial-card p {
            font-size: clamp(0.98rem, 0.9rem + 0.25vw, 1.08rem);
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
            padding: clamp(1.2rem, 2.3vw, 1.85rem);
            height: 100%;
        }

        .contact-list {
            display: grid;
            gap: 0;
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
            flex-direction: column;
            align-items: stretch;
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
            gap: 0.6rem;
            padding: 0.35rem 0 0.9rem;
        }

        .store-address i {
            color: #999;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .store-address span {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.65;
        }

        .map-card iframe {
            width: 100%;
            height: 100%;
            min-height: clamp(300px, 42vw, 460px);
            border: 0;
            border-radius: 22px;
        }

        .site-footer {
            padding: clamp(2.25rem, 5vw, 3rem) 0 1.3rem;
            background: #0e1f2a;
            color: rgba(255, 255, 255, 0.82);
        }

        .site-footer p {
            color: rgba(255, 255, 255, 0.72);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.8rem;
        }

        .footer-brand {
            display: inline-block;
            color: #fff;
            margin: 0 0 0.6rem;
        }

        .footer-logo {
            height: clamp(78px, 12vw, 112px);
            width: auto;
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

        .swal2-popup.swal-landing-popup {
            border-radius: 24px;
            padding: 1.4rem 1.25rem 1.2rem;
            box-shadow: 0 24px 55px rgba(16, 33, 50, 0.18);
        }

        .swal2-title.swal-landing-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.35rem;
            color: var(--text);
        }

        .swal2-html-container.swal-landing-content {
            font-size: 0.95rem;
            color: var(--muted);
            line-height: 1.7;
        }

        .swal2-confirm.swal-landing-confirm {
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), #ff4d4d) !important;
            box-shadow: 0 14px 30px rgba(255, 2, 5, 0.22);
            font-weight: 700;
            padding: 0.8rem 1.5rem;
        }

        .swal2-icon.swal2-info {
            border-color: rgba(255, 2, 5, 0.24) !important;
            color: var(--primary) !important;
        }

        @media (max-width: 991.98px) {
            :root {
                --nav-offset: 86px;
            }

            .navbar {
                padding-top: 0.65rem;
            }

            .navbar .container {
                padding: 0.72rem;
                border-radius: 20px;
            }

            .navbar-collapse {
                margin-top: 0.8rem;
                padding: 0.75rem;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.88);
                border: 1px solid rgba(255, 255, 255, 0.56);
                box-shadow: 0 18px 34px rgba(16, 33, 50, 0.1);
            }

            .navbar-nav {
                gap: 0.35rem;
                align-items: stretch !important;
            }

            .nav-link {
                width: 100%;
            }

            .navbar .btn-brand {
                width: 100%;
            }

            .hero-slide {
                min-height: clamp(610px, 95svh, 780px);
            }

            .stats-section {
                margin-top: -2rem;
            }

            .footer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 768px) {

            .stats-grid,
            .footer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

        @media (max-width: 767.98px) {
            :root {
                --section-pad: clamp(3.45rem, 9vw, 4.6rem);
                --container-pad: 1rem;
                --nav-offset: 82px;
            }

            .section-heading {
                margin-bottom: 1.7rem;
            }

            .navbar .container {
                padding: 0.68rem;
            }

            .navbar-logo {
                height: 58px;
            }

            .hero-slide {
                min-height: clamp(590px, 94svh, 720px);
                padding: 6.15rem 0 3.6rem;
                background-position: 58% center;
            }

            .hero-content {
                max-width: 100%;
            }

            .hero-content h1,
            .hero-content h2 {
                font-size: clamp(2rem, 10vw, 3rem);
            }

            .hero-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .hero-actions .btn-brand,
            .hero-actions .btn-outline-light {
                width: 100%;
                min-width: 0;
            }

            .stats-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                min-height: 0;
            }

            .product-image {
                height: 250px;
            }

            .contact-card,
            .map-card,
            .testimonial-card,
            .empty-products-card {
                border-radius: 22px;
            }

            .testimonial-controls {
                gap: 0.55rem;
                flex-wrap: wrap;
            }

            .control-btn {
                width: 44px;
                height: 44px;
            }
        }

        @media (max-width: 575.98px) {

            .section-tag,
            .eyebrow {
                font-size: 0.72rem;
                padding: 0.4rem 0.75rem;
            }

            .empty-products-card {
                padding: 2rem 1.2rem;
            }

            .empty-products-card .btn {
                width: 100%;
            }

            .product-body {
                padding: 1.05rem;
            }

            .footer-logo {
                height: 74px;
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

            .footer-grid {
                grid-template-columns: 1.2fr 0.9fr 0.9fr;
            }
        }

        @media (min-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" data-scroll-target="#home">
                <img src="{{ asset('assets/logo-navbar.png') }}" alt="Ar-Rahman E-Bike Bondowoso" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-0 align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"
                            data-scroll-target="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"
                            data-scroll-target="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"
                            data-scroll-target="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"
                            data-scroll-target="#kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-brand" href="https://wa.me/6285231260016"
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
                                    <p>Ar-Rahman E-Bike Bondowoso menghadirkan pilihan sepeda listrik untuk mobilitas
                                        harian, usaha, hingga gaya hidup modern.</p>
                                    <div class="hero-actions">
                                        <a href="{{ route('home') }}" data-scroll-target="#produk"
                                            class="btn btn-brand">Lihat Produk</a>
                                        <a href="{{ route('home') }}" data-scroll-target="#kontak"
                                            class="btn btn-outline-light">Kunjungi Toko</a>
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
                                        <a href="https://wa.me/6285231260016" class="btn btn-brand" target="_blank"
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
                                        <a href="{{ route('home') }}" data-scroll-target="#testimoni"
                                            class="btn btn-outline-light">Lihat Testimoni</a>
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
                        <p>Konsultasi cepat melalui WhatsApp untuk cek stok.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="section-space products-section">
            <div class="container">
                <div class="section-heading text-center">
                    <span class="section-tag">Produk Pilihan</span>
                    <h3>Model sepeda listrik yang siap menunjang mobilitas Anda</h3>
                    <p>Pilih unit favorit dengan desain modern, fitur nyaman, dan harga yang lebih menarik. Lihat juga
                        <a href="{{ route('home') }}" data-scroll-target="#kontak">layanan purna jual</a> kami!</p>
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
                                        @if ($product->old_price)
                                            <span
                                                class="old-price">Rp{{ number_format($product->old_price, 0, ',', '.') }}</span>
                                        @endif
                                        <span
                                            class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                    @if ($product->link)
                                        <a href="{{ route('products.click', $product) }}" target="_blank"
                                            rel="noopener" class="btn btn-brand w-100">
                                            <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-brand w-100 product-unavailable-btn"
                                            data-product-name="{{ $product->name }}"
                                            data-track-url="{{ route('products.click', $product) }}">
                                            <i class="fa-solid fa-cart-shopping me-2"></i>Beli Produk
                                        </button>
                                    @endif
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
                                <p>Kami sedang memperbarui koleksi produk terbaru untuk Anda. Silakan hubungi kami untuk
                                    informasi produk terkini.</p>
                                <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20tanya%20tentang%20produk%20sepeda%20listrik"
                                    target="_blank" class="btn btn-brand">
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
                    <h3>Apa kata pelanggan Ar-Rahman E-Bike Bondowoso</h3>
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
                            <p>Kunjugi toko kami untuk melihat langsung berbagai model sepeda listrik dan berkonsultasi
                                dengan tim kami untuk menemukan solusi transportasi yang paling sesuai dengan kebutuhan
                                dan budget Anda.</p>
                            <ul class="contact-list list-unstyled mb-0">
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
                                        UWINFLY PUJER BONDOWOSO
                                    </div>
                                    <div class="store-address">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>Jl. Raya Pakisan No.51, Krasak, Maskuning Kulon, Kec. Pujer, Kabupaten
                                            Bondowoso, Jawa Timur 68271</span>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <a href="tel:+6285231260016">+62 852-3126-0016</a>
                                    /
                                    <a href="tel:+6281331978800">+62 813-3197-8800</a>
                                </li>
                                <li>
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <a href="https://wa.me/6285231260016" target="_blank" rel="noopener">+62
                                        852-3126-0016</a>
                                    /
                                    <a href="https://wa.me/6281331978800" target="_blank" rel="noopener">+62
                                        813-3197-8800</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Siap melayani konsultasi pembelian dan info stok produk.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-shop"></i>
                                    <a href="https://shopee.co.id/diahayuros8" target="_blank" rel="noopener">Shopee - Ar-Rahman E-Bike</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="map-card h-100">
                            <iframe title="Lokasi Ar-Rahman E-Bike Bondowoso"
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
                    <a class="footer-brand" href="{{ route('home') }}" data-scroll-target="#home">
                        <img src="{{ asset('assets/logo-footer.png') }}" alt="Ar-Rahman E-Bike Bondowoso"
                            class="footer-logo">
                    </a>
                    <p>Pusat penjualan sepeda listrik di Bondowoso dengan pilihan model modern, nyaman, dan siap pakai
                        untuk aktivitas sehari-hari.</p>
                </div>
                <div>
                    <h3>Navigasi</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="{{ route('home') }}" data-scroll-target="#home">Home</a></li>
                        <li><a href="{{ route('home') }}" data-scroll-target="#produk">Produk</a></li>
                        <li><a href="{{ route('home') }}" data-scroll-target="#testimoni">Testimoni</a></li>
                        <li><a href="{{ route('home') }}" data-scroll-target="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Kontak</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="tel:+6285231260016">+62 852-3126-0016</a></li>
                        <li><a href="tel:+6281331978800">+62 813-3197-8800</a></li>
                        <li><a href="https://wa.me/6285231260016" target="_blank" rel="noopener">WhatsApp 1</a></li>
                        <li><a href="https://wa.me/6281331978800" target="_blank" rel="noopener">WhatsApp 2</a></li>
                        <li><span>Bondowoso, Jawa Timur</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 Ar-Rahman E-Bike Bondowoso. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarCollapseEl = document.getElementById('mainNavbar');
            const navbarCollapse = navbarCollapseEl ? bootstrap.Collapse.getOrCreateInstance(navbarCollapseEl, {
                toggle: false
            }) : null;
            const unavailableButtons = document.querySelectorAll('.product-unavailable-btn');
            const productAlert = @json(session('product_alert'));

            const showProductAlert = function(payload) {
                const title = payload?.title || 'Link pembelian belum tersedia';
                const message = payload?.message ||
                    'Link pembelian produk ini belum tersedia saat ini. Silakan hubungi toko untuk informasi pemesanan lebih lanjut.';
                const icon = payload?.icon || 'info';

                if (typeof Swal === 'undefined') {
                    window.alert(message);
                    return;
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message,
                    confirmButtonText: 'Mengerti',
                    buttonsStyling: false,
                    customClass: {
                        popup: 'swal-landing-popup',
                        title: 'swal-landing-title',
                        htmlContainer: 'swal-landing-content',
                        confirmButton: 'swal-landing-confirm'
                    }
                });
            };

            if (productAlert) {
                showProductAlert(productAlert);
            }

            unavailableButtons.forEach(function(button) {
                button.addEventListener('click', async function() {
                    const productName = this.dataset.productName || 'Produk ini';
                    const trackUrl = this.dataset.trackUrl;
                    const fallbackPayload = {
                        icon: 'info',
                        title: 'Link pembelian belum tersedia',
                        message: `Link pembelian untuk ${productName} belum tersedia saat ini. Silakan hubungi toko untuk informasi pemesanan lebih lanjut.`
                    };

                    if (!trackUrl) {
                        showProductAlert(fallbackPayload);
                        return;
                    }

                    this.disabled = true;

                    try {
                        const response = await fetch(trackUrl, {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const payload = await response.json();
                        showProductAlert(response.ok ? payload : fallbackPayload);
                    } catch (error) {
                        showProductAlert(fallbackPayload);
                    } finally {
                        this.disabled = false;
                    }
                });
            });

            const scrollToSection = function(hash) {
                const target = document.querySelector(hash);

                if (!target) {
                    return false;
                }

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                if (navbarCollapseEl && navbarCollapseEl.classList.contains('show')) {
                    navbarCollapse.hide();
                }

                window.history.replaceState(null, '', `${window.location.pathname}${window.location.search}`);

                return true;
            };

            document.querySelectorAll('[data-scroll-target]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const hash = this.dataset.scrollTarget;

                    e.preventDefault();
                    scrollToSection(hash);
                });
            });

            if (window.location.hash) {
                requestAnimationFrame(function() {
                    scrollToSection(window.location.hash);
                });
            }
        });
    </script>
</body>

</html>
