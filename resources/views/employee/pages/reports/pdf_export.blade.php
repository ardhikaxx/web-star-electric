<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Harian - {{ $report->report_date->format('d/m/Y') }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        
        .meta-table { width: 100%; margin-bottom: 20px; }
        .meta-table td { padding: 5px; vertical-align: top; }
        .meta-label { font-weight: bold; width: 100px; }
        
        table.main-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.main-table th { background-color: #eee; border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; }
        table.main-table td { border: 1px solid #ddd; padding: 8px; }
        
        h2 { font-size: 14px; border-left: 4px solid #444; padding-left: 8px; margin: 20px 0 10px; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 9px; color: #999; text-align: center; }
    </style>
</head>
<body>
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    <div class="header">
        <h1>Laporan Harian Penjualan</h1>
    </div>

    <table class="meta-table">
        <tr>
            <td class="meta-label">Tanggal</td><td>: {{ $report->report_date->translatedFormat('d F Y') }}</td>
            <td class="meta-label">Karyawan</td><td>: {{ $report->user->name }}</td>
        </tr>
        <tr>
            <td class="meta-label">Lokasi</td><td>: {{ $report->location->name }}</td>
            <td class="meta-label">Catatan</td><td>: {{ $report->notes ?: '-' }}</td>
        </tr>
    </table>

    <h2>Penjualan Produk</h2>
    <table class="main-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Type</th>
                <th>Warna</th>
                <th>Qty</th>
                <th>Pembayaran</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($report->productSales as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->product_type ?: '-' }}</td>
                    <td>{{ $item->color ?: '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ strtoupper($item->payment_type) }}</td>
                    <td class="text-right">{{ $currency($item->price) }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center;">Tidak ada penjualan produk.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($report->sparepartSales->count() > 0)
    <h2>Penjualan Sparepart</h2>
    <table class="main-table">
        <thead>
            <tr>
                <th>Nama Sparepart</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->sparepartSales as $item)
                <tr>
                    <td>{{ $item->sparepart_name }}</td>
                    <td class="text-right">{{ $currency($item->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if($report->shippings->count() > 0 || $report->services->count() > 0)
    <h2>Ongkir dan Service</h2>
    <table class="main-table">
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->shippings as $item)
                <tr>
                    <td>{{ $item->shipping_type === 'sale' ? 'Ongkir Penjualan' : 'Ongkir Retur' }}</td>
                    <td>{{ $item->product_name ?: '-' }}</td>
                    <td class="text-right">{{ $currency($item->price) }}</td>
                </tr>
            @endforeach
            @foreach ($report->services as $item)
                <tr>
                    <td>Service / Perbaikan</td>
                    <td>{{ $item->service_name }}</td>
                    <td class="text-right">{{ $currency($item->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>