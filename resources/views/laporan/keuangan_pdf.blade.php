<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #6b7280;
            padding-bottom: 10px;
        }
        .store-title {
            font-size: 20px;
            font-weight: bold;
            color: #4f46e5;
        }
        .store-info {
            font-size: 10px;
            color: #6b7280;
        }
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .summary-card {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: bold;
        }
        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #10b981;
            margin-top: 5px;
        }
        .summary-desc {
            font-size: 10px;
            color: #6b7280;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
            color: #374151;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%; border: none; margin-bottom: 0;">
            <tr>
                <td style="border: none; padding: 0; width: 60%;">
                    <div class="store-title">{{ $profil->nama_toko ?? 'AutoClean' }}</div>
                    <div class="store-info">
                        {{ $profil->alamat ?? '-' }}<br>
                        Telp: {{ $profil->no_telepon ?? '-' }} | Email: {{ $profil->email ?? '-' }}
                    </div>
                </td>
                <td style="border: none; padding: 0; width: 40%; text-align: right; vertical-align: middle;">
                    <div style="font-size: 10px; color: #6b7280;">Tanggal Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">{{ $judul }}</div>

    <div class="summary-card">
        <div class="summary-title">Total Pendapatan</div>
        <div class="summary-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        <div class="summary-desc">Dari {{ $pembayaran->count() }} transaksi selesai</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 25%;">Waktu Bayar</th>
                <th style="width: 20%;">No. Antrian</th>
                <th style="width: 25%;">Layanan</th>
                <th style="width: 15%;">Metode</th>
                <th style="width: 15%;" class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayaran as $p)
                <tr>
                    <td>{{ $p->waktu_bayar->format('d/m/Y H:i') }}</td>
                    <td class="font-bold">{{ $p->transaksi->nomor_antrian }}</td>
                    <td>{{ $p->transaksi->layanan->nama }}</td>
                    <td style="text-transform: capitalize;">{{ $p->metode_pembayaran }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="color: #6b7280;">Tidak ada data pendapatan pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        @if($pembayaran->count() > 0)
        <tfoot>
            <tr class="font-bold" style="background-color: #f9fafb;">
                <td colspan="4" class="text-right" style="border-top: 2px solid #e5e7eb; padding: 10px 8px;">TOTAL KESELURUHAN</td>
                <td class="text-right" style="border-top: 2px solid #e5e7eb; padding: 10px 8px; color: #10b981; font-size: 12px;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} {{ $profil->nama_toko ?? 'AutoClean' }}. Laporan ini dibuat secara otomatis oleh sistem.
    </div>
</body>
</html>
