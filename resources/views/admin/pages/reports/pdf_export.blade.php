<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Admin - {{ $periodLabel }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 12px; color: #666; }
        
        .summary-table { width: 100%; margin-bottom: 20px; }
        .summary-table td { width: 33.33%; padding: 10px; }
        .summary-card { border: 1px solid #ddd; padding: 10px; text-align: center; border-radius: 5px; background-color: #f9f9f9; }
        .summary-card strong { display: block; font-size: 9px; color: #777; margin-bottom: 5px; text-transform: uppercase; }
        .summary-card span { font-size: 14px; font-weight: bold; color: #000; }

        table.main-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.main-table th { background-color: #eee; border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold; }
        table.main-table td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 9px; color: #999; text-align: right; font-style: italic; }
        
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    @php $currency = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.'); @endphp

    <div class="header">
        <h1>Laporan Penjualan Ar-Rahman E-Bike</h1>
        <p>Periode: {{ $periodLabel }}</p>
    </div>

    <table class="summary-table">
        <tr>
            <td>
                <div class="summary-card">
                    <strong>Total Omzet</strong>
                    <span>{{ $currency($summary['gross_revenue']) }}</span>
                </div>
            </td>
            <td>
                <div class="summary-card">
                    <strong>Total Keuntungan</strong>
                    <span>{{ $currency($summary['profit']) }}</span>
                </div>
            </td>
            <td>
                <div class="summary-card">
                    <strong>Jumlah Laporan</strong>
                    <span>{{ number_format($summary['reports']) }}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="12%">Tanggal</th>
                <th width="20%">Karyawan</th>
                <th width="20%">Lokasi</th>
                <th width="24%" class="text-right">Omzet</th>
                <th width="24%" class="text-right">Keuntungan</th>
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
        <tfoot>
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="3" class="text-right">TOTAL KESELURUHAN</td>
                <td class="text-right">{{ $currency($summary['gross_revenue']) }}</td>
                <td class="text-right">{{ $currency($summary['profit']) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh sistem pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>