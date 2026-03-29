<p align="center">
  <img src="public/assets/logo.png" width="200" alt="Ar-Rahman E-Bike Bondowoso">
</p>

<h1 align="center">AR-RAHMAN E-BIKE BONDOWOSO</h1>

<p align="center">
  Website resmi penjualan dan layanan sepeda listrik terpercaya di Bondowoso, Jawa Timur.<br>
  <strong>Tech Stack:</strong> Laravel 11 + Bootstrap 5 + MySQL
</p>

---

## 🚀 Tentang Kami

**Ar-Rahman E-Bike Bondowoso** adalah toko spesialis penjualan dan layanan sepeda listrik yang berlokasi di Bondowoso, Jawa Timur. Kami menyediakan berbagai pilihan sepeda listrik dari berbagai merk ternama dengan harga bersaing dan kualitas terjamin. Tersedia juga layanan service, sparepart, dan pembelian online melalui Shopee.

---

## ✨ Fitur

### 🌐 Landing Page (Frontend)
- **Hero Section** - Tampilan utama yang menarik dengan Call-to-Action
- **Produk** - Daftar lengkap produk sepeda listrik dengan harga dan deskripsi
- **Testimoni** - Widget Google Reviews dari SociableKit
- **Kontak & Lokasi** - Informasi kontak, 3 toko offline, dan link Shopee
- **SEO Optimization** - Meta keywords dan description yang optimal
- **WhatsApp Integration** - Pemesanan langsung via WhatsApp
- **Responsive Design** - Tampilan optimal di semua device (desktop, tablet, mobile)

### 🖥️ Admin Panel
- **Dashboard** - Statistik produk dan klik produk
- **Manajemen Produk** - CRUD lengkap (tambah, edit, hapus produk)
- **Tracking** - Pencatatan klik produk untuk analitik
- **Ganti PIN** - Sistem keamanan dengan PIN 4 digit
- **Login System** - Login dengan PIN admin yang aman

---

## 🛠️ Tech Stack

| Kategori | Teknologi |
|----------|-----------|
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Frontend** | Bootstrap 5, Font Awesome 6 |
| **Database** | MySQL |
| **Design** | Custom responsive design |
| **External** | SociableKit (Google Reviews), SweetAlert2 |
| **Icons** | Font Awesome 6.6.0 |

---

## 📦 Installation

```bash
# Clone repository
git clone https://github.com/ardhikaxx/web-star-electric.git

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migration
php artisan migrate

# Seed default data (optional)
php artisan db:seed --class=AdminSettingSeeder

# Run development server
php artisan serve
```

---

## 👤 Default Credentials

| Item | Value |
|------|-------|
| PIN Admin | `1234` |
| WhatsApp Utama | `+62 852-3126-0016` |
| WhatsApp Cadangan | `+62 813-3197-8800` |

---

## 🏪 Lokasi Toko Offline

| No | Nama Toko | Alamat |
|----|-----------|--------|
| 1 | ARRAHMAN E-BIKE BONDOWOSO | Depan Dinas Pengairan, Jl. Ahmad Yani No.89, Penatu, Badean, Kec. Bondowoso, Kab. Bondowoso, Jawa Timur 68214 |
| 2 | STAR SEPEDA LISTRIK | Jl. Ahmad Yani No.89, Penatu, Badean, Kec. Bondowoso, Kab. Bondowoso, Jawa Timur 68214 |
| 3 | UWINFLY PUJER BONDOWOSO | Jl. Raya Pakisan No.51, Krasak, Maskuning Kulon, Kec. Pujer, Kab. Bondowoso, Jawa Timur 68271 |

---

## 📂 Struktur Project

```
sepeda-listrik/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # Admin controllers
│   │   ├── LandingController.php
│   │   └── ProductController.php
│   └── Models/
│       ├── AdminSetting.php
│       └── Product.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── assets/                 # Images, logos, product images
│   └── assets/css/
│   └── assets/js/
├── resources/
│   └── views/
│       ├── admin/              # Admin panel views
│       ├── index.blade.php     # Landing page
├── routes/
│   └── web.php
└── .env
```

---

## 📱 Screenshots

### Landing Page
- Hero section dengan CTA dan gambar produk
- Daftar produk lengkap dengan harga dan tombolbeli
- Widget Google Reviews
- Peta lokasi dan informasi kontak
- Footer dengan tautan navigasi

### Admin Panel
- Dashboard dengan statistik produk dan klik
- Tampilan tabel manajemen produk
- Form tambah/edit produk

---

## 📞 Kontak & Sosial Media

| Channel | Info |
|---------|------|
| 📍 Alamat | Bondowoso, Jawa Timur |
| 📞 Telepon | +62 852-3126-0016 / +62 813-3197-8800 |
| 💬 WhatsApp | [Hubungi via WhatsApp](https://wa.me/6285231260016) |
| 🛒 Shopee | [Ar-Rahman E-bike Bondowoso Official](https://shopee.co.id/diahayuros8) |

---

## 📝 Lisensi

MIT License - Copyright © 2026 Ar-Rahman E-Bike Bondowoso

---

<p align="center">Made with ❤️ for Ar-Rahman E-Bike Bondowoso</p>