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

        .image-upload-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-preview-wrapper {
            position: relative;
            aspect-ratio: 1/1;
            border-radius: var(--radius-md);
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
            background: var(--primary-light-alpha);
        }

        .image-preview-wrapper.has-image {
            border-style: solid;
        }

        .image-preview-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            background: var(--danger);
            color: #fff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .upload-placeholder {
            text-align: center;
            color: var(--muted);
            padding: 0.5rem;
        }

        .upload-placeholder i {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
            display: block;
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <!-- Image Card -->
                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-image me-2"></i>Foto Produk</h3>
                    </div>
                    <div class="form-card-body">
                        <label class="form-label">Upload Beberapa Foto <span class="required">*</span></label>
                        <div class="image-upload-container" id="imageContainer">
                            <div class="image-preview-wrapper" id="addMoreBtn">
                                <div class="upload-placeholder">
                                    <i class="fa-solid fa-plus"></i>
                                    <div style="font-weight: 700; font-size: 0.8rem;">Tambah Foto</div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="images[]" id="imageInput" class="d-none" multiple
                            accept="image/jpeg,image/png,image/webp">
                        
                        <div class="mt-4">
                            <div class="alert alert-info py-2 px-3 mb-0" style="font-size: 0.8rem; border-radius: var(--radius-sm);">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                Klik "+" untuk menambah foto. Foto pertama akan menjadi foto utama. (Max 2MB per foto)
                            </div>
                        </div>
                        @error('images')
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
                                    <input type="text" name="price" id="priceInput"
                                        class="form-control-custom form-control-price format-price @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="0">
                                </div>
                                @error('price')
                                    <div class="error-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Harga Coret (Diskon)</label>
                                <div class="price-input-wrapper">
                                    <span class="price-symbol">Rp</span>
                                    <input type="text" name="old_price" id="oldPriceInput"
                                        class="form-control-custom form-control-price format-price @error('old_price') is-invalid @enderror"
                                        value="{{ old('old_price') }}" placeholder="0">
                                </div>                                <div class="price-helper">
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
            const addMoreBtn = document.getElementById('addMoreBtn');
            const imageInput = document.getElementById('imageInput');
            const imageContainer = document.getElementById('imageContainer');
            const priceInput = document.getElementById('priceInput');
            const oldPriceInput = document.getElementById('oldPriceInput');
            let dataTransfer = new DataTransfer();

            function setupOldPriceSuggestion(priceField, oldPriceField) {
                if (!priceField || !oldPriceField) return;
                let oldPriceManuallyEdited = oldPriceField.value.trim() !== '';
                function parseNumeric(value) { return Number(String(value).replace(/[^\d]/g, '')) || 0; }
                function getRoundingBase(price) {
                    if (price >= 5000000) return 100000;
                    if (price >= 1000000) return 50000;
                    if (price >= 100000) return 10000;
                    return 1000;
                }
                function suggestOldPrice(price) {
                    if (!price) return '';
                    const roundingBase = getRoundingBase(price);
                    const suggested = Math.ceil((price * 1.15) / roundingBase) * roundingBase;
                    return suggested <= price ? price + roundingBase : suggested;
                }
                function syncOldPrice() {
                    const currentPrice = parseNumeric(priceField.value);
                    if (!currentPrice) { if (!oldPriceManuallyEdited) oldPriceField.value = ''; return; }
                    oldPriceField.value = suggestOldPrice(currentPrice);
                }
                if (!oldPriceManuallyEdited && parseNumeric(priceField.value) > 0) syncOldPrice();
                priceField.addEventListener('input', () => { if (!oldPriceManuallyEdited) syncOldPrice(); });
                oldPriceField.addEventListener('input', () => {
                    oldPriceManuallyEdited = oldPriceField.value.trim() !== '';
                    if (!oldPriceManuallyEdited) syncOldPrice();
                });
            }

                // Handle form submission to clean price formats
            document.getElementById('productForm').addEventListener('submit', function() {
                const priceInput = document.getElementById('priceInput');
                const oldPriceInput = document.getElementById('oldPriceInput');
                
                // Clean input values by removing thousand separators
                priceInput.value = priceInput.value.replace(/\./g, '');
                oldPriceInput.value = oldPriceInput.value.replace(/\./g, '');
            });

            setupOldPriceSuggestion(priceInput, oldPriceInput);

            addMoreBtn.addEventListener('click', () => imageInput.click());

            imageInput.addEventListener('change', function() {
                Array.from(this.files).forEach(file => {
                    if (file.type.match('image.*')) {
                        dataTransfer.items.add(file);
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'image-preview-wrapper has-image';
                            wrapper.innerHTML = `
                                <img src="${e.target.result}">
                                <button type="button" class="remove-image"><i class="fa-solid fa-xmark"></i></button>
                            `;
                            
                            const removeBtn = wrapper.querySelector('.remove-image');
                            removeBtn.onclick = (event) => {
                                event.stopPropagation();
                                const idx = Array.from(imageContainer.querySelectorAll('.has-image')).indexOf(wrapper);
                                wrapper.remove();
                                removeFileFromFileList(idx);
                            };
                            
                            imageContainer.insertBefore(wrapper, addMoreBtn);
                        };
                        reader.readAsDataURL(file);
                    }
                });
                imageInput.files = dataTransfer.files;
            });

            function removeFileFromFileList(index) {
                const newDataTransfer = new DataTransfer();
                const files = dataTransfer.files;
                for (let i = 0; i < files.length; i++) {
                    if (i !== index) newDataTransfer.items.add(files[i]);
                }
                dataTransfer = newDataTransfer;
                imageInput.files = dataTransfer.files;
            }

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
