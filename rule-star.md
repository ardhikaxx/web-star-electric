# Rule Star - Admin Manajemen Sepeda Listrik

## 1. Struktur Project

### 1.1 Teknologi

- **Framework**: Laravel 12
- **Frontend**: Bootstrap 5.3 (CDN), Font Awesome 6 (CDN)
- **Database**: MySQL (sudah ada di project)
- **File Storage**: Public folder (`public/uploads/products/`)

### 1.2 Struktur Folder Admin

```
resources/views/admin/
├── layouts/
│   ├── master.blade.php      # Layout utama admin
│   ├── sidebar.blade.php     # Sidebar navigasi
│   └── header.blade.php      # Header admin
├── pages/
│   ├── login.blade.php       # Halaman login PIN
│   ├── dashboard.blade.php   # Dashboard dengan stats
│   └── products/
│       ├── index.blade.php   # List produk
│       ├── create.blade.php  # Tambah produk
│       └── edit.blade.php    # Edit produk
├── partials/
│   └── breadcrumb.blade.php  # Breadcrumb component
```

---

## 2. Admin Login (PIN 4 Digit)

### 2.1 Spesifikasi

- **Route**: `/admin/login`
- **Method**: POST ke `/admin/login`
- **PIN**: 4 digit angka (contoh: `1234`)
- **Session**: Laravel session untuk auth admin

### 2.2 Fitur

- Input PIN dengan maxlength="4"
- Validasi hanya angka
- Pesan error jika PIN salah
- Redirect ke dashboard jika berhasil

---

## 3. Dashboard

### 3.1 Stats Cards

- **Total Produk**: Jumlah produk yang ada
- **Produk Aktif**: Produk yang ditampilkan di landing page
- **Total Views**: (opsional, bisa diabaikan)

### 3.2 Layout

- Menggunakan grid Bootstrap
- Card stats dengan ikon dan angka
- Responsive (1 kolom mobile, 2 tablet, 3-4 desktop)

---

## 4. Manajemen Produk

### 4.1 Fields

| Field       | Tipe                        | Validasi                             |
| ----------- | --------------------------- | ------------------------------------ |
| Gambar      | File (jpg, png, jpeg, webp) | max 2MB, di public/uploads/products/ |
| Nama Produk | Text                        | required, max 255                    |
| Deskripsi   | Textarea                    | required                             |
| Harga       | Number                      | required, min 0                      |
| Link Produk | URL                         | optional                             |

### 4.2 CRUD Operations

- **Create**: Tambah produk baru dengan upload gambar ke public folder
- **Read**: Tampilkan list produk dengan pagination
- **Update**: Edit produk (gambar opsional)
- **Delete**: Hapus produk (juga hapus gambar)

### 4.3 Image Handling

- Simpan di: `public/uploads/products/`
- Format: `product_{timestamp}_{original_name}.{ext}`
- Hapus gambar lama saat update/delete

---

## 5. Integrasi dengan Landing Page

### 5.1 Menampilkan Produk

- Jika ada produk: looping produk dari database
- Jika tidak ada produk: tampilkan pesan/keterangan

### 5.2 Path Gambar

- Gunakan `asset('uploads/products/filename.jpg')`
- Bukan `storage_link()`

---

## 6. Desain Admin (Mobile-First)

### 6.1 Strategi

1. Build untuk layar ponsel terlebih dahulu
2. Sesuaikan untuk tablet ( breakpoint md)
3. Sesuaikan untuk desktop (breakpoint lg/xl)

### 6.2 Warna (Mengikuti Landing Page)

```css
:root {
    --bg: #f4f8fb;
    --surface: rgba(255, 255, 255, 0.72);
    --surface-strong: #ffffff;
    --text: #102132;
    --muted: #607080;
    --primary: #0c8f74;
    --primary-dark: #086d59;
    --accent: #f59e0b;
    --line: rgba(16, 33, 50, 0.08);
    --shadow: 0 20px 60px rgba(8, 19, 33, 0.12);
    --radius-lg: 28px;
    --radius-md: 20px;
    --radius-sm: 16px;
}
```

### 6.3 Sidebar

- **Mobile**: Offcanvas (muncul dari kiri)
- **Desktop**: Fixed sidebar di kiri (250px)
- Toggle button untuk mobile

### 6.4 Komponen UI

- Card dengan shadow dan border-radius
- Buttons mengikuti style landing page
- Form inputs dengan styling konsisten
- Tables dengan responsive wrapper
- Breadcrumb di setiap halaman

---

## 7. Blade Templates

### 7.1 Master Layout

```blade
@extends('admin.layouts.master')

@stack('styles')

@yield('content')

@stack('scripts')
```

### 7.2 Breadcrumb Component

```blade
@include('admin.partials.breadcrumb', [
    'links' => [
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Produk', 'url' => route('admin.products.index')],
        ['label' => 'Tambah']
    ]
])
```

### 7.3 Page Structure

```blade
@push('styles')
<style>
    /* Page specific styles */
</style>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <!-- Page content -->
@endsection

@push('scripts')
<script>
    // Page specific scripts
</script>
@endpush
```

---

## 8. Routes

### 8.1 Admin Routes

| Method | Route                     | Controller                |
| ------ | ------------------------- | ------------------------- |
| GET    | /admin/login              | AuthController@showLogin  |
| POST   | /admin/login              | AuthController@login      |
| POST   | /admin/logout             | AuthController@logout     |
| GET    | /admin/dashboard          | DashboardController@index |
| GET    | /admin/products           | ProductController@index   |
| GET    | /admin/products/create    | ProductController@create  |
| POST   | /admin/products           | ProductController@store   |
| GET    | /admin/products/{id}/edit | ProductController@edit    |
| PUT    | /admin/products/{id}      | ProductController@update  |
| DELETE | /admin/products/{id}      | ProductController@destroy |

---

## 9. Database Schema

### 9.1 Table: products

```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(500) NULL,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## 10. Checklist Implementasi

- [ ] Setup routes admin
- [ ] Buat middleware untuk proteksi admin
- [ ] Halaman login dengan PIN
- [ ] Dashboard dengan stats cards
- [ ] CRUD produk lengkap
- [ ] Upload gambar ke public folder
- [ ] Integrasi produk ke landing page
- [ ] Warning jika tidak ada produk
- [ ] Responsive design mobile-first
- [ ] Sidebar admin (offcanvas mobile, fixed desktop)
- [ ] Breadcrumb di setiap halaman
- [ ] Styling sesuai landing page

---

## Catatan Penting

1. **PIN Admin Default**: `1234` (bisa diubah via database/env)
2. **Public Folder**: Semua gambar produk disimpan di `public/uploads/products/`
3. **Asset Helper**: Gunakan `asset()` untuk menampilkan gambar
4. **Responsive**: Gunakan class Bootstrap (`col-12 col-md-6 col-lg-4`)
5. ** Konsisten**: Ikuti design system dari landing page (warna, font, spacing)
