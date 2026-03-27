@extends('admin.layouts.main')

@section('title', 'Tambah Produk - Admin')
@section('page-title', 'Tambah Produk')

@push('styles')
    <style>
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .page-header h2 {
            margin: 0;
            font-size: clamp(1.45rem, 1.2rem + 1vw, 1.82rem);
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            line-height: 1.2;
        }

        .page-header h2 i {
            background: var(--primary-light-alpha);
            color: var(--primary);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.25rem;
        }

        .form-card {
            background: #fff;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .form-card-header {
            padding: clamp(1.15rem, 2vw, 1.5rem) clamp(1.2rem, 2.5vw, 2rem);
            border-bottom: 1px solid var(--line);
            background: rgba(248, 251, 253, 0.5);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.85rem;
            flex-wrap: wrap;
        }

        .form-card-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-card-body {
            padding: clamp(1.2rem, 2.6vw, 2rem);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--muted);
            margin-bottom: 0.75rem;
            display: block;
        }

        .form-label .required {
            color: var(--danger);
        }

        .input-group-custom {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .input-group-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            z-index: 10;
            pointer-events: none;
            font-size: 1rem;
        }

        .form-control-custom {
            padding: 0.875rem 1.25rem 0.875rem 3.5rem;
            border-radius: var(--radius-md);
            border: 2px solid var(--line);
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #fff;
            width: 100%;
            display: block;
            min-height: 58px;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light-alpha);
            outline: none;
        }

        .form-control-custom:focus + i {
            color: var(--primary);
        }

        textarea.form-control-custom {
            padding-left: 1.25rem;
            min-height: 150px;
        }

        .image-preview-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: var(--bg-light);
            border: 2px dashed var(--line);
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview-wrapper:hover {
            border-color: var(--primary);
            transform: scale(1.02);
        }

        .image-preview-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .upload-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: var(--muted);
            width: 100%;
            padding: 1rem;
        }

        .upload-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--line);
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            opacity: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .image-preview-wrapper.has-image:hover .image-overlay {
            opacity: 1;
        }

        .image-overlay i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            background: var(--bg-light);
            border: 1px solid var(--line);
            white-space: nowrap;
        }

        .status-badge.active {
            background: var(--success-light-alpha);
            color: var(--success);
            border-color: rgba(16, 185, 129, 0.2);
        }

        .custom-switch {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-light);
            border-radius: var(--radius-md);
            border: 1px solid var(--line);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-switch:hover {
            border-color: var(--primary);
        }

        .custom-switch .form-check-input {
            width: 3.5rem;
            height: 1.75rem;
            margin-top: 0;
            cursor: pointer;
        }

        .custom-switch .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .action-bar {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn-modern {
            padding: 0.9rem 1.8rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            min-height: 56px;
        }

        .btn-modern-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 12px rgba(255, 2, 5, 0.3);
        }

        .btn-modern-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 2, 5, 0.4);
            color: #fff;
        }

        .btn-modern-light {
            background: #fff;
            color: var(--muted);
            border: 2px solid var(--line);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .btn-modern-light:hover {
            background: var(--bg-light);
            border-color: rgba(16, 33, 50, 0.15);
            color: var(--text);
            transform: translateY(-2px);
        }

        .error-feedback {
            color: var(--danger);
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .price-input-wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }

        .price-symbol {
            position: absolute;
            left: 1.25rem;
            font-weight: 800;
            color: var(--primary);
            z-index: 10;
        }

        .form-control-price {
            padding-left: 3.5rem;
        }

        .price-helper {
            margin-top: 0.65rem;
            color: var(--muted);
            font-size: 0.78rem;
            line-height: 1.55;
        }

        @media (max-width: 991.98px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .status-badge {
                width: fit-content;
            }
            
            .action-bar {
                flex-direction: column;
                width: 100%;
            }

            .btn-modern {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 767.98px) {
            .page-header h2 i {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                font-size: 1.1rem;
            }

            .status-badge {
                width: 100%;
                justify-content: center;
                border-radius: 16px;
            }

            .image-preview-wrapper {
                max-width: 360px;
                margin-inline: auto;
            }

            .custom-switch {
                padding: 0.9rem;
                align-items: flex-start;
            }
        }

        @media (max-width: 575.98px) {
            .form-card {
                border-radius: 22px;
            }

            .btn-modern {
                padding-inline: 1.2rem;
            }
        }
    </style>
@endpush

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Produk', 'url' => route('admin.products.index')],
            ['label' => 'Tambah Produk'],
        ],
    ])

    <div class="page-header d-flex align-items-center justify-content-between mb-4">
        <h2>
            <i class="fa-solid fa-plus"></i>
            Tambah Produk
        </h2>
        <div class="status-badge active" id="statusBadge">
            <i class="fa-solid fa-circle-check"></i>
            Produk Aktif
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <!-- Image Card -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-image me-2"></i>Foto Produk</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="image-preview-wrapper" id="imageUploadArea">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <div style="font-weight: 700; font-size: 0.95rem;">Klik untuk pilih foto</div>
                                <div style="font-size: 0.8rem;">atau tarik gambar ke sini</div>
                            </div>
                            <img src="" id="previewImg" alt="Preview">
                            <div class="image-overlay">
                                <i class="fa-solid fa-camera-rotate"></i>
                                <span>Ganti Foto Produk</span>
                            </div>
                        </div>
                        <input type="file" name="image" id="imageInput" class="d-none"
                            accept="image/jpeg,image/png,image/webp">
                        
                        <div class="mt-4">
                            <div class="alert alert-info py-2 px-3 mb-0" style="font-size: 0.8rem; border-radius: var(--radius-sm);">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                Format: JPG, PNG, WebP (Max 2MB). Foto produk wajib diisi.
                            </div>
                        </div>
                        @error('image')
                            <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status Card -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-sliders me-2"></i>Pengaturan</h3>
                    </div>
                    <div class="form-card-body">
                        <label class="form-label">Status Visibilitas</label>
                        <label class="custom-switch" for="isActive">
                            <div class="form-check form-switch p-0 m-0">
                                <input class="form-check-input ms-0" type="checkbox" name="is_active" id="isActive"
                                    value="1" checked>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: var(--text); font-size: 0.9rem;">Tampilkan Produk</div>
                                <div style="font-size: 0.75rem; color: var(--muted);">Produk akan langsung terlihat publik</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <!-- General Info Card -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-circle-info me-2"></i>Informasi Umum</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="mb-4">
                            <label class="form-label">Nama Produk <span class="required">*</span></label>
                            <div class="input-group-custom">
                                <span class="input-group-icon" aria-hidden="true">
                                    <i class="fa-solid fa-box"></i>
                                </span>
                                <input type="text" name="name"
                                    class="form-control-custom @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama produk sepeda listrik">
                            </div>
                            @error('name')
                                <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi Lengkap <span class="required">*</span></label>
                            <textarea name="description" class="form-control-custom @error('description') is-invalid @enderror"
                                placeholder="Jelaskan detail, spesifikasi, dan keunggulan produk...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Link Pembelian (Opsional)</label>
                            <div class="input-group-custom">
                                <span class="input-group-icon" aria-hidden="true">
                                    <i class="fa-solid fa-link"></i>
                                </span>
                                <input type="url" name="link"
                                    class="form-control-custom @error('link') is-invalid @enderror"
                                    value="{{ old('link') }}"
                                    placeholder="https://shopee.co.id/produk-anda">
                            </div>
                            <div class="mt-2" style="font-size: 0.75rem; color: var(--muted);">
                                Arahkan pembeli ke halaman marketplace atau WhatsApp.
                            </div>
                            @error('link')
                                <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-tags me-2"></i>Informasi Harga</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Harga Jual <span class="required">*</span></label>
                                <div class="price-input-wrapper">
                                    <span class="price-symbol">Rp</span>
                                    <input type="number" name="price" id="priceInput"
                                        class="form-control-custom form-control-price @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="0" min="0">
                                </div>
                                @error('price')
                                    <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga Coret (Diskon)</label>
                                <div class="price-input-wrapper">
                                    <span class="price-symbol">Rp</span>
                                    <input type="number" name="old_price" id="oldPriceInput"
                                        class="form-control-custom form-control-price @error('old_price') is-invalid @enderror"
                                        value="{{ old('old_price') }}" placeholder="0"
                                        min="0">
                                </div>
                                <div class="price-helper">
                                    Otomatis disarankan sekitar 15% di atas harga jual agar diskon terlihat lebih menarik. Tetap bisa Anda ubah manual.
                                </div>
                                @error('old_price')
                                    <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-bar">
                    <a href="{{ route('admin.products.index') }}" class="btn-modern btn-modern-light">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        Simpan Produk
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUploadArea = document.getElementById('imageUploadArea');
            const imageInput = document.getElementById('imageInput');
            const previewImg = document.getElementById('previewImg');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const priceInput = document.getElementById('priceInput');
            const oldPriceInput = document.getElementById('oldPriceInput');

            function setupOldPriceSuggestion(priceField, oldPriceField) {
                if (!priceField || !oldPriceField) {
                    return;
                }

                let oldPriceManuallyEdited = oldPriceField.value.trim() !== '';

                function parseNumeric(value) {
                    return Number(String(value).replace(/[^\d]/g, '')) || 0;
                }

                function getRoundingBase(price) {
                    if (price >= 5000000) {
                        return 100000;
                    }

                    if (price >= 1000000) {
                        return 50000;
                    }

                    if (price >= 100000) {
                        return 10000;
                    }

                    return 1000;
                }

                function suggestOldPrice(price) {
                    if (!price) {
                        return '';
                    }

                    const roundingBase = getRoundingBase(price);
                    const suggested = Math.ceil((price * 1.15) / roundingBase) * roundingBase;
                    return suggested <= price ? price + roundingBase : suggested;
                }

                function syncOldPrice() {
                    const currentPrice = parseNumeric(priceField.value);

                    if (!currentPrice) {
                        if (!oldPriceManuallyEdited) {
                            oldPriceField.value = '';
                        }

                        return;
                    }

                    oldPriceField.value = suggestOldPrice(currentPrice);
                }

                if (!oldPriceManuallyEdited && parseNumeric(priceField.value) > 0) {
                    syncOldPrice();
                }

                priceField.addEventListener('input', function() {
                    if (!oldPriceManuallyEdited) {
                        syncOldPrice();
                    }
                });

                oldPriceField.addEventListener('input', function() {
                    oldPriceManuallyEdited = oldPriceField.value.trim() !== '';

                    if (!oldPriceManuallyEdited) {
                        syncOldPrice();
                    }
                });
            }

            setupOldPriceSuggestion(priceInput, oldPriceInput);

            imageUploadArea.addEventListener('click', function() {
                imageInput.click();
            });

            // Drag and drop handling
            imageUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                imageUploadArea.style.borderColor = 'var(--primary)';
                imageUploadArea.style.background = 'var(--primary-light-alpha)';
            });

            imageUploadArea.addEventListener('dragleave', function() {
                imageUploadArea.style.borderColor = '';
                imageUploadArea.style.background = '';
            });

            imageUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                imageUploadArea.style.borderColor = '';
                imageUploadArea.style.background = '';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    imageInput.files = files;
                    handleImagePreview(files[0]);
                }
            });

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    handleImagePreview(this.files[0]);
                }
            });

            function handleImagePreview(file) {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                        uploadPlaceholder.style.display = 'none';
                        imageUploadArea.classList.add('has-image');
                        
                        // Visual feedback for success
                        imageUploadArea.style.borderColor = 'var(--success)';
                        setTimeout(() => {
                            imageUploadArea.style.borderColor = 'var(--line)';
                        }, 2000);
                    };
                    reader.readAsDataURL(file);
                }
            }

            // Smoothly update the status badge when toggle changes
            const isActiveToggle = document.getElementById('isActive');
            const statusBadge = document.getElementById('statusBadge');
            
            isActiveToggle.addEventListener('change', function() {
                if(this.checked) {
                    statusBadge.classList.add('active');
                    statusBadge.innerHTML = '<i class="fa-solid fa-circle-check"></i> Produk Aktif';
                } else {
                    statusBadge.classList.remove('active');
                    statusBadge.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Draft / Nonaktif';
                }
            });
        });
    </script>
@endpush
