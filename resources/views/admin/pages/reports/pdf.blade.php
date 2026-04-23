<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - {{ $periodLabel }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0; color: #666; }
        .summary-box { display: flex; gap: 20px; margin-bottom: 30px; }
        .summary-item { flex: 1; border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center; }
        .summary-item strong { display: block; margin-bottom: 5px; color: #666; font-size: 10px; text-transform: uppercase; }
        .summary-item span { font-size: 16px; font-weight: bold; color: #111; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 10px; color: #999; text-align: right; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #007bff; color: #fff; border: none; border-radius: 4px; font-weight: bold;">
            Cetak Laporan / Simpan PDF
        </button>
        <p style="margin-top: 10px; font-size: 11px; color: #666;">Gunakan fitur browser (Ctrl+P) untuk menyimpan sebagai PDF.</p>
    </div>

    <div class="header">
        <h1>Laporan Penjualan Ar-Rahman E-Bike</h1>
        <p>Periode: {{ $periodLabel }}</p>
    </div>

    <div class="summary-box">
        <div class="summary-item">
            <strong>Total Omzet</strong>
            <span>{{ $currency($summary['gross_revenue']) }}</span>
        </div>
        <div class="summary-item">
            <strong>Total Keuntungan</strong>
            <span>{{ $currency($summary['profit']) }}</span>
        </div>
        <div class="summary-item">
            <strong>Jumlah Laporan</strong>
            <span>{{ number_format($summary['reports']) }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Karyawan</th>
                <th>Lokasi</th>
                <th class="text-right">Omzet</th>
                <th class="text-right">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                @php $metrics = $report->calculateMetrics(); @endphp
                <tr>
                    <td>{{ $report->report_date->format('d/m/Y') }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->location->name }}</td>
                    <td class="text-right">{{ $currency($metrics['gross_revenue']) }}</td>
                    <td class="text-right">{{ $currency($metrics['profit']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>

    <script>
        window.addEventListener('load', function() {
            // Optional auto-print trigger
            // window.print();
        });
    </script>
</body>
</html>