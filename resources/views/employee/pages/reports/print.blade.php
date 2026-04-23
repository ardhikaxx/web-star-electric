<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Laporan {{ $report->report_date->format('d-m-Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; margin: 32px; }
        h1, h2 { margin: 0 0 12px; }
        .meta { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-bottom: 24px; }
        .box { border: 1px solid #d1d5db; border-radius: 8px; padding: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { border: 1px solid #d1d5db; padding: 10px; text-align: left; }
        th { background: #f3f4f6; }
        .summary { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; margin-bottom: 24px; }
        @media print { body { margin: 12px; } .print-btn { display: none; } }
    </style>
</head>
<body>
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    <button class="print-btn" onclick="window.print()">Print / Simpan PDF</button>
    <h1>Laporan Harian Penjualan</h1>
    <div class="meta">
        <div class="box"><strong>Tanggal</strong><div>{{ $report->report_date->translatedFormat('d F Y') }}</div></div>
        <div class="box"><strong>Karyawan</strong><div>{{ $report->user->name }}</div></div>
        <div class="box"><strong>Lokasi</strong><div>{{ $report->location->name }}</div></div>
        <div class="box"><strong>Catatan</strong><div>{{ $report->notes ?: '-' }}</div></div>
    </div>

    <h2>Penjualan Produk</h2>
    <table>
        <thead>
            <tr><th>Produk</th><th>Type</th><th>Warna</th><th>Qty</th><th>Pembayaran</th><th>Harga</th></tr>
        </thead>
        <tbody>
            @forelse ($report->productSales as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->product_type ?: '-' }}</td>
                    <td>{{ $item->color ?: '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ strtoupper($item->payment_type) }}</td>
                    <td>{{ $currency($item->price) }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Tidak ada penjualan produk.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Penjualan Sparepart</h2>
    <table>
        <thead>
            <tr><th>Sparepart</th><th>Harga</th></tr>
        </thead>
        <tbody>
            @forelse ($report->sparepartSales as $item)
                <tr><td>{{ $item->sparepart_name }}</td><td>{{ $currency($item->price) }}</td></tr>
            @empty
                <tr><td colspan="2">Tidak ada penjualan sparepart.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Ongkir dan Service</h2>
    <table>
        <thead>
            <tr><th>Jenis</th><th>Deskripsi</th><th>Harga</th></tr>
        </thead>
        <tbody>
            @foreach ($report->shippings as $item)
                <tr>
                    <td>{{ $item->shipping_type === 'sale' ? 'Ongkir Penjualan' : 'Ongkir Retur' }}</td>
                    <td>{{ $item->product_name ?: '-' }}</td>
                    <td>{{ $currency($item->price) }}</td>
                </tr>
            @endforeach
            @foreach ($report->services as $item)
                <tr>
                    <td>Service</td>
                    <td>{{ $item->service_name }}</td>
                    <td>{{ $currency($item->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>
</body>
</html>
