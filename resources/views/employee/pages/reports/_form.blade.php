@php
    $report = $report ?? null;
    $productRows = collect(old('product_sales', $report?->productSales->map(fn ($item) => [
        'row_key' => $item->row_key ?: 'product-' . $item->id,
        'sales_product_id' => $item->sales_product_id,
        'product_name' => $item->product_name,
        'product_type' => $item->product_type,
        'color' => $item->color,
        'payment_type' => $item->payment_type,
        'price' => (int) $item->price,
        'quantity' => $item->quantity,
    ])->all() ?? [['row_key' => 'product-' . uniqid(), 'sales_product_id' => '', 'product_type' => '', 'color' => '', 'payment_type' => 'dp', 'price' => '', 'quantity' => 1]]));
    
    $sparepartRows = collect(old('sparepart_sales', $report?->sparepartSales->map(fn ($item) => [
        'sparepart_name' => $item->sparepart_name,
        'price' => (int) $item->price,
    ])->all() ?? []));
    
    $shippingSaleRows = collect(old('shipping_sales', $report?->shippings->where('shipping_type', 'sale')->map(fn ($item) => [
        'product_row_key' => $item->productSale?->row_key ?? '',
        'price' => (int) $item->price,
    ])->all() ?? []));
    
    $returnShippingRows = collect(old('return_shippings', $report?->shippings->where('shipping_type', 'return')->map(fn ($item) => [
        'product_name' => $item->product_name,
        'price' => (int) $item->price,
    ])->all() ?? []));
    
    $serviceRows = collect(old('services', $report?->services->map(fn ($item) => [
        'service_name' => $item->service_name,
        'price' => (int) $item->price,
    ])->all() ?? []));
@endphp

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-4">
        <label class="form-label">Tanggal Laporan</label>
        <input type="date" name="report_date" class="form-control @error('report_date') is-invalid @enderror" value="{{ old('report_date', optional($report?->report_date)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
        @error('report_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">Lokasi Toko</label>
        <select name="store_location_id" class="form-select @error('store_location_id') is-invalid @enderror" required>
            <option value="">Pilih lokasi</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" @selected((string) old('store_location_id', $report->store_location_id ?? '') === (string) $location->id)>{{ $location->name }}</option>
            @endforeach
        </select>
        @error('store_location_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">Catatan</label>
        <input type="text" name="notes" class="form-control" value="{{ old('notes', $report->notes ?? '') }}" placeholder="Opsional">
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Pelaporan Penjualan Produk</span>
        <button type="button" class="btn btn-sm btn-primary" data-add-row="product-sales">
            <i class="fa-solid fa-plus me-1"></i>Tambah
        </button>
    </div>
    <div class="card-body d-flex flex-column gap-3" data-row-container="product-sales">
        @error('product_sales')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @foreach ($productRows as $index => $row)
            <div class="border rounded p-3 report-row">
                <input type="hidden" name="product_sales[{{ $index }}][row_key]" value="{{ $row['row_key'] }}" class="product-row-key">
                <div class="row g-3">
                    <div class="col-12 col-lg-3">
                        <label class="form-label">Produk Penjualan</label>
                        <select name="product_sales[{{ $index }}][sales_product_id]" class="form-select select2-product product-sale-id" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($salesProducts as $salesProduct)
                                <option value="{{ $salesProduct->id }}" data-name="{{ $salesProduct->name }}" @selected((string) $row['sales_product_id'] === (string) $salesProduct->id)>
                                    {{ $salesProduct->name }} (Stok: {{ $salesProduct->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Type</label>
                        <input type="text" name="product_sales[{{ $index }}][product_type]" class="form-control" value="{{ $row['product_type'] }}">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Warna</label>
                        <input type="text" name="product_sales[{{ $index }}][color]" class="form-control" value="{{ $row['color'] }}">
                    </div>
                    <div class="col-12 col-lg-1">
                        <label class="form-label">Qty</label>
                        <input type="number" name="product_sales[{{ $index }}][quantity]" class="form-control" value="{{ $row['quantity'] }}" min="1" required>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Pembayaran</label>
                        <select name="product_sales[{{ $index }}][payment_type]" class="form-select">
                            <option value="dp" @selected($row['payment_type'] === 'dp')>DP</option>
                            <option value="lunas" @selected($row['payment_type'] === 'lunas')>Lunas</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" min="0" name="product_sales[{{ $index }}][price]" class="form-control" value="{{ $row['price'] }}">
                    </div>
                    <div class="col-12 col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Pelaporan Penjualan Sparepart</span>
        <button type="button" class="btn btn-sm btn-primary" data-add-row="spareparts">
            <i class="fa-solid fa-plus me-1"></i>Tambah
        </button>
    </div>
    <div class="card-body d-flex flex-column gap-3" data-row-container="spareparts">
        @foreach ($sparepartRows as $index => $row)
            <div class="border rounded p-3 report-row">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Nama Sparepart</label>
                        <input type="text" name="sparepart_sales[{{ $index }}][sparepart_name]" class="form-control" value="{{ $row['sparepart_name'] }}">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" min="0" name="sparepart_sales[{{ $index }}][price]" class="form-control" value="{{ $row['price'] }}">
                    </div>
                    <div class="col-12 col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Pelaporan Ongkir Penjualan</span>
        <button type="button" class="btn btn-sm btn-primary" data-add-row="shipping-sales">
            <i class="fa-solid fa-plus me-1"></i>Tambah
        </button>
    </div>
    <div class="card-body d-flex flex-column gap-3" data-row-container="shipping-sales">
        @foreach ($shippingSaleRows as $index => $row)
            <div class="border rounded p-3 report-row">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Produk Penjualan</label>
                        <select name="shipping_sales[{{ $index }}][product_row_key]" class="form-select shipping-product-select" data-selected="{{ $row['product_row_key'] }}"></select>
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="form-label">Harga Ongkir</label>
                        <input type="number" step="0.01" min="0" name="shipping_sales[{{ $index }}][price]" class="form-control" value="{{ $row['price'] }}">
                    </div>
                    <div class="col-12 col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Pelaporan Ongkir Retur</span>
        <button type="button" class="btn btn-sm btn-primary" data-add-row="return-shippings">
            <i class="fa-solid fa-plus me-1"></i>Tambah
        </button>
    </div>
    <div class="card-body d-flex flex-column gap-3" data-row-container="return-shippings">
        @foreach ($returnShippingRows as $index => $row)
            <div class="border rounded p-3 report-row">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Nama Produk Retur</label>
                        <input type="text" name="return_shippings[{{ $index }}][product_name]" class="form-control" value="{{ $row['product_name'] }}">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="form-label">Harga Ongkir</label>
                        <input type="number" step="0.01" min="0" name="return_shippings[{{ $index }}][price]" class="form-control" value="{{ $row['price'] }}">
                    </div>
                    <div class="col-12 col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Pelaporan Perbaikan / Service</span>
        <button type="button" class="btn btn-sm btn-primary" data-add-row="services">
            <i class="fa-solid fa-plus me-1"></i>Tambah
        </button>
    </div>
    <div class="card-body d-flex flex-column gap-3" data-row-container="services">
        @foreach ($serviceRows as $index => $row)
            <div class="border rounded p-3 report-row">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Nama Perbaikan</label>
                        <input type="text" name="services[{{ $index }}][service_name]" class="form-control" value="{{ $row['service_name'] }}">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="form-label">Harga Perbaikan</label>
                        <input type="number" step="0.01" min="0" name="services[{{ $index }}][price]" class="form-control" value="{{ $row['price'] }}">
                    </div>
                    <div class="col-12 col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const initSelect2 = (el) => {
                $(el).select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Pilih Produk',
                    width: '100%'
                });
            };

            initSelect2('.select2-product');

            const counters = {
                productSales: document.querySelectorAll('[data-row-container="product-sales"] .report-row').length,
                spareparts: document.querySelectorAll('[data-row-container="spareparts"] .report-row').length,
                shippingSales: document.querySelectorAll('[data-row-container="shipping-sales"] .report-row').length,
                returnShippings: document.querySelectorAll('[data-row-container="return-shippings"] .report-row').length,
                services: document.querySelectorAll('[data-row-container="services"] .report-row').length,
            };

            const getProductOptions = function () {
                return Array.from(document.querySelectorAll('[data-row-container="product-sales"] .report-row')).map(function (row) {
                    const select = row.querySelector('.product-sale-id');
                    const selectedOption = select?.options[select.selectedIndex];
                    return {
                        key: row.querySelector('.product-row-key')?.value || '',
                        name: selectedOption ? selectedOption.getAttribute('data-name') : ''
                    };
                }).filter(function (item) {
                    return item.key && item.name;
                });
            };

            const refreshShippingProductOptions = function () {
                const options = getProductOptions();

                document.querySelectorAll('.shipping-product-select').forEach(function (select) {
                    const selected = select.dataset.selected || select.value;
                    select.innerHTML = '<option value="">Pilih penjualan produk</option>';

                    options.forEach(function (option) {
                        const node = document.createElement('option');
                        node.value = option.key;
                        node.textContent = option.name;
                        if (selected === option.key) {
                            node.selected = true;
                        }
                        select.appendChild(node);
                    });
                });
            };

            const createRow = function (section) {
                if (section === 'product-sales') {
                    const index = counters.productSales++;
                    const rowKey = 'product-' + Date.now() + '-' + index;
                    const options = $('#sales-product-template-options').html();
                    
                    return `
                        <div class="border rounded p-3 report-row">
                            <input type="hidden" name="product_sales[${index}][row_key]" value="${rowKey}" class="product-row-key">
                            <div class="row g-3">
                                <div class="col-12 col-lg-3">
                                    <label class="form-label">Produk Penjualan</label>
                                    <select name="product_sales[${index}][sales_product_id]" class="form-select select2-product-new product-sale-id" required>
                                        <option value="">Pilih Produk</option>
                                        ${options}
                                    </select>
                                </div>
                                <div class="col-12 col-lg-2"><label class="form-label">Type</label><input type="text" name="product_sales[${index}][product_type]" class="form-control"></div>
                                <div class="col-12 col-lg-2"><label class="form-label">Warna</label><input type="text" name="product_sales[${index}][color]" class="form-control"></div>
                                <div class="col-12 col-lg-1"><label class="form-label">Qty</label><input type="number" name="product_sales[${index}][quantity]" class="form-control" value="1" min="1" required></div>
                                <div class="col-12 col-lg-2"><label class="form-label">Pembayaran</label><select name="product_sales[${index}][payment_type]" class="form-select"><option value="dp">DP</option><option value="lunas">Lunas</option></select></div>
                                <div class="col-12 col-lg-2"><label class="form-label">Harga</label><input type="number" step="0.01" min="0" name="product_sales[${index}][price]" class="form-control"></div>
                                <div class="col-12 col-lg-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button></div>
                            </div>
                        </div>
                    `;
                }

                if (section === 'spareparts') {
                    const index = counters.spareparts++;
                    return `
                        <div class="border rounded p-3 report-row">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6"><label class="form-label">Nama Sparepart</label><input type="text" name="sparepart_sales[${index}][sparepart_name]" class="form-control"></div>
                                <div class="col-12 col-lg-5"><label class="form-label">Harga</label><input type="number" step="0.01" min="0" name="sparepart_sales[${index}][price]" class="form-control"></div>
                                <div class="col-12 col-lg-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button></div>
                            </div>
                        </div>
                    `;
                }

                if (section === 'shipping-sales') {
                    const index = counters.shippingSales++;
                    return `
                        <div class="border rounded p-3 report-row">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6"><label class="form-label">Produk Penjualan</label><select name="shipping_sales[${index}][product_row_key]" class="form-select shipping-product-select"></select></div>
                                <div class="col-12 col-lg-5"><label class="form-label">Harga Ongkir</label><input type="number" step="0.01" min="0" name="shipping_sales[${index}][price]" class="form-control"></div>
                                <div class="col-12 col-lg-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button></div>
                            </div>
                        </div>
                    `;
                }

                if (section === 'return-shippings') {
                    const index = counters.returnShippings++;
                    return `
                        <div class="border rounded p-3 report-row">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6"><label class="form-label">Nama Produk Retur</label><input type="text" name="return_shippings[${index}][product_name]" class="form-control"></div>
                                <div class="col-12 col-lg-5"><label class="form-label">Harga Ongkir</label><input type="number" step="0.01" min="0" name="return_shippings[${index}][price]" class="form-control"></div>
                                <div class="col-12 col-lg-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button></div>
                            </div>
                        </div>
                    `;
                }

                const index = counters.services++;
                return `
                    <div class="border rounded p-3 report-row">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6"><label class="form-label">Nama Perbaikan</label><input type="text" name="services[${index}][service_name]" class="form-control"></div>
                            <div class="col-12 col-lg-5"><label class="form-label">Harga Perbaikan</label><input type="number" step="0.01" min="0" name="services[${index}][price]" class="form-control"></div>
                            <div class="col-12 col-lg-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="fa-solid fa-minus"></i></button></div>
                        </div>
                    </div>
                `;
            };

            $('[data-add-row]').on('click', function () {
                const section = $(this).data('add-row');
                const $container = $(`[data-row-container="${section}"]`);
                const html = createRow(section);
                $container.append(html);
                
                if (section === 'product-sales') {
                    initSelect2($container.find('.select2-product-new').last());
                }
                
                refreshShippingProductOptions();
            });

            $(document).on('click', '[data-remove-row]', function () {
                $(this).closest('.report-row').remove();
                refreshShippingProductOptions();
            });

            $(document).on('change', '.product-sale-id', function () {
                refreshShippingProductOptions();
            });

            refreshShippingProductOptions();
        });
    </script>
    
    <script type="text/template" id="sales-product-template-options">
        @foreach ($salesProducts as $salesProduct)
            <option value="{{ $salesProduct->id }}" data-name="{{ $salesProduct->name }}">
                {{ $salesProduct->name }} (Stok: {{ $salesProduct->stock }})
            </option>
        @endforeach
    </script>
@endpush
