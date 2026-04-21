<div class="row g-4">
    <div class="col-12 col-lg-6">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $salesProduct->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">Harga Beli</label>
        <input type="number" step="0.01" min="0" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $salesProduct->purchase_price ?? '') }}" required>
        @error('purchase_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">Harga Jual</label>
        <input type="number" step="0.01" min="0" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', $salesProduct->selling_price ?? '') }}" required>
        @error('selling_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">Stok</label>
        <input type="number" min="0" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $salesProduct->stock ?? 0) }}" required>
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                {{ old('is_active', isset($salesProduct) ? (int) $salesProduct->is_active : 1) ? 'checked' : '' }}>
            <span class="form-check-label">Produk aktif</span>
        </label>
    </div>
</div>
