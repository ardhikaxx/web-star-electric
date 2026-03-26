@extends('admin.layouts.main')

@section('title', 'Edit Produk - Admin')

@push('styles')
    <style>
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header h2 i {
            color: var(--primary);
        }

        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .form-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .form-card-header h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
        }

        .form-card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .form-label .required {
            color: var(--danger);
        }

        .form-control,
        .form-select {
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light-alpha); /* Changed to use primary color */
        }
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .image-upload-area {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--bg-light);
        }

        .image-upload-area:hover {
            border-color: var(--primary);
            background: rgba(230, 32, 38, 0.05);
        }

        .image-upload-area.has-image {
            padding: 0;
            border-style: solid;
            border-color: var(--success);
        }

        .image-upload-area i {
            font-size: 2.5rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .image-upload-area p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .image-upload-area .browse-text {
            color: var(--primary);
            font-weight: 600;
        }

        .current-image {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            border-radius: 10px;
        }

        .image-input {
            display: none;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(230, 32, 38, 0.25);
        }

        .form-switch .form-check-input {
            width: 3rem;
            height: 1.5rem;
        }

        .btn-submit {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: transparent;
            color: var(--text-muted);
            border: 2px solid var(--border);
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            border-color: var(--text-muted);
            color: var(--text);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .change-image-text {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .image-wrapper {
            position: relative;
        }

        @media (max-width: 767.98px) {
            .action-buttons {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush


@section('content')
    <div class="admin-wrapper">
        @include('admin.layouts.sidebar')

        <div class="main-content">
            @include('admin.layouts.header')

            <div class="page-content">
                @include('admin.partials.breadcrumb', [
                    'links' => [
                        ['label' => 'Admin', 'url' => route('admin.dashboard')],
                        ['label' => 'Produk', 'url' => route('admin.products.index')],
                        ['label' => 'Edit Produk'],
                    ],
                ])

                <div class="page-header">
                    <h2>
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit Produk
                    </h2>
                </div>

                <div class="form-card">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-box me-2"></i>Form Edit Produk</h3>
                    </div>
                    <div class="form-card-body">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12 col-md-4 mb-4">
                                    <label class="form-label">
                                        Gambar Produk
                                    </label>
                                    <div class="image-upload-area has-image image-wrapper" id="imageUploadArea">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="current-image"
                                            alt="{{ $product->name }}">
                                        <span class="change-image-text">
                                            <i class="fa-solid fa-camera me-1"></i>
                                            Klik untuk ganti gambar
                                        </span>
                                    </div>
                                    <input type="file" name="image" id="imageInput" class="image-input"
                                        accept="image/jpeg,image/png,image/webp">
                                    <p class="form-hint">JPG, PNG, WebP max 2MB. Kosongkan jika tidak ingin mengubah.</p>
                                    @error('image')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Nama Produk <span class="required">*</span>
                                        </label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $product->name) }}"
                                            placeholder="Contoh: Sepeda Listrik Model X1">
                                        @error('name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Deskripsi Produk <span class="required">*</span>
                                        </label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Tuliskan deskripsi produk...">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Harga <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border-radius: 10px 0 0 10px;">Rp</span>
                                            <input type="number" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price', $product->price) }}" placeholder="0" min="0">
                                        </div>
                                        @error('price')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Harga Coret (Opsional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="border-radius: 10px 0 0 10px;">Rp</span>
                                            <input type="number" name="old_price"
                                                class="form-control @error('old_price') is-invalid @enderror"
                                                value="{{ old('old_price', $product->old_price) }}" placeholder="0"
                                                min="0">
                                        </div>
                                        <p class="form-hint">Harga asli sebelum diskon (akan ditampilkan dengan garis coret)
                                        </p>
                                        @error('old_price')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Link Produk (Opsional)</label>
                                        <input type="url" name="link"
                                            class="form-control @error('link') is-invalid @enderror"
                                            value="{{ old('link', $product->link) }}"
                                            placeholder="https://example.com/product">
                                        <p class="form-hint">Link ke marketplace atau website penjualan</p>
                                        @error('link')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                                                value="1"
                                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isActive">
                                                Tampilkan di Landing Page
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="action-buttons">
                                <button type="submit" class="btn-submit">
                                    <i class="fa-solid fa-save"></i>
                                    Update Produk
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                                    <i class="fa-solid fa-times"></i>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay"></div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUploadArea = document.getElementById('imageUploadArea');
            const imageInput = document.getElementById('imageInput');

            imageUploadArea.addEventListener('click', function() {
                imageInput.click();
            });

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imageUploadArea.innerHTML = `
                            <img src="${e.target.result}" class="current-image" alt="Preview">
                            <span class="change-image-text">
                                <i class="fa-solid fa-camera me-1"></i>
                                Klik untuk ganti gambar
                            </span>
                        `;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>
@endpush
