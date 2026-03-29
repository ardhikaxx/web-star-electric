# 🚴 Ar-Rahman E-Bike Bondowoso

<p align="center">
  <img src="public/assets/logo.png" width="180" alt="Ar-Rahman E-Bike Bondowoso">
</p>

<p align="center">
  Website resmi penjualan dan layanan <strong>sepeda listrik terpercaya</strong> di Bondowoso, Jawa Timur
</p>

<p align="center">
  <a href="https://github.com/ardhikaxx/web-star-electric">
    <img src="https://img.shields.io/github/license/ardhikaxx/web-star-electric?style=for-the-badge" alt="License">
  </a>
  <a href="https://laravel.com">
    <img src="https://img.shields.io/badge/Laravel-11-orange?style=for-the-badge&logo=laravel" alt="Laravel">
  </a>
  <a href="https://getbootstrap.com">
    <img src="https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap">
  </a>
  <a href="https://php.net">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP">
  </a>
</p>

---

## 📋 Daftar Isi

- [Tentang Kami](#tentang-kami)
- [Fitur](#fitur)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Konfigurasi](#konfigurasi)
- [Lokasi Toko](#lokasi-toko)
- [Struktur Project](#struktur-project)
- [Kontak](#kontak)
- [Lisensi](#lisensi)

---

## 🎯 Tentang Kami

**Ar-Rahman E-Bike Bondowoso** adalah toko spesialis penjualan dan layanan sepeda listrik yang berlokasi di Bondowoso, Jawa Timur. Kami menyediakan berbagai pilihan sepeda listrik dari berbagai merk ternama dengan harga bersaing dan kualitas terjamin.

### 💡 Mengapa Memilih Kami?

✅ **Produk Berkualitas** - Sepeda listrik dari merk terpercaya dengan garansi resmi

✅ **Harga Kompetitif** - Harga terbaik dengan berbagai pilihan budget

✅ **Layanan Purna Jual** - Service center dan sparepart tersedia

✅ **3 Toko Offline** - Mudah dikunjungi untuk melihat dan mencoba langsung

✅ **Belanja Online** - Tersedia juga di Shopee untuk kemudahan pembelian

✅ **Konsultasi Gratis** - Tim kami siap membantu memilih produk yang tepat

---

## ✨ Fitur

### 🌐 Landing Page (Frontend)

| Fitur | Deskripsi |
|-------|-----------|
| 🏠 **Hero Section** | Tampilan utama menarik dengan Call-to-Action |
| 🛒 **Daftar Produk** | Produk lengkap dengan harga, deskripsi, dan gambar |
| ⭐ **Testimoni** | Widget Google Reviews dari SociableKit |
| 📍 **Kontak & Lokasi** | Info kontak, 3 toko offline, dan link Shopee |
| 🔍 **SEO Optimization** | Meta tags optimal untuk mesin pencari |
| 💬 **WhatsApp Integration** | Pemesanan langsung via WhatsApp |
| 📱 **Responsive Design** | Tampilan optimal di semua device |
| 🗺️ **Google Maps** | Peta lokasi toko terintegrasi |

### 🖥️ Admin Panel

| Fitur | Deskripsi |
|-------|-----------|
| 📊 **Dashboard** | Statistik produk dan klik produk |
| 📦 **Manajemen Produk** | CRUD lengkap (Create, Read, Update, Delete) |
| 📈 **Tracking** | Pencatatan klik produk untuk analitik |
| 🔐 **Ganti PIN** | Sistem keamanan dengan PIN 4 digit |
| 🔑 **Login System** | Login aman dengan PIN |

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 11
- **PHP:** Version 8.2+
- **Database:** MySQL

### Frontend
- **CSS Framework:** Bootstrap 5
- **Icons:** Font Awesome 6.6.0
- **Fonts:** Google Fonts (Plus Jakarta Sans, Sora)

### External Services
- **Google Reviews:** SociableKit Widget
- **Maps:** Google Maps Embed
- **Notifications:** SweetAlert2
- **Communication:** WhatsApp API

---

## 📦 Installation

```bash
# 1. Clone repository
git clone https://github.com/ardhikaxx/web-star-electric.git

# 2. Masuk ke direktori project
cd web-star-electric

# 3. Install dependencies
composer install
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sepeda_listrik
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Run database migration
php artisan migrate

# 8. Seed default data (optional)
php artisan db:seed --class=AdminSettingSeeder

# 9. Run development server
php artisan serve
```

---

## ⚙️ Konfigurasi

### Default Credentials

| Item | Value |
|------|-------|
| PIN Admin | `1234` |
| WhatsApp Utama | `+62 852-3126-0016` |
| WhatsApp Cadangan | `+62 813-3197-8800` |

### Environment Variables

```env
APP_NAME="Ar-Rahman E-Bike Bondowoso"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sepeda_listrik
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🏪 Lokasi Toko Offline

### 1. Toko Utama - ARRAHMAN E-BIKE BONDOWOSO
- 📍 **Alamat:** Depan Dinas Pengairan, Jl. Ahmad Yani No.89, Penatu, Badean, Kec. Bondowoso, Kab. Bondowoso, Jawa Timur 68214
- 📞 **Telepon:** +62 852-3126-0016

### 2. Toko Cabang - STAR SEPEDA LISTRIK
- 📍 **Alamat:** Jl. Ahmad Yani No.89, Penatu, Badean, Kec. Bondowoso, Kab. Bondowoso, Jawa Timur 68214

### 3. Toko Koordinator - UWINFLY PUJER BONDOWOSO
- 📍 **Alamat:** Jl. Raya Pakisan No.51, Krasak, Maskuning Kulon, Kec. Pujer, Kab. Bondowoso, Jawa Timur 68271

---

## 📞 Kontak & Sosial Media Kontak & Sosial Media

| Channel | Link |
|---------|------|
| 📍 **Alamat** | Bondowoso, Jawa Timur |
| 📞 **Telepon** | +62 852-3126-0016 / +62 813-3197-8800 |
| 💬 **WhatsApp** | [Hubungi via WhatsApp](https://wa.me/6285231260016) |
| 🛒 **Shopee** | [Ar-Rahman E-bike Bondowoso Official](https://shopee.co.id/diahayuros8) |

---

## 🤝 Kontribusi

Kontribusi selalu welcome! Silakan buat pull request atau laporkan issues di repository.

---

## 📝 Lisensi

MIT License - Copyright © 2026 Ar-Rahman E-Bike Bondowoso

---

<p align="center">Made with ❤️ for Ar-Rahman E-Bike Bondowoso</p>