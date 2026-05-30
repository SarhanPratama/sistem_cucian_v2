<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggan Setia</title>
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
        .top-rank {
            background-color: #fffbeb;
        }
        .medal {
            font-size: 14px;
        }
        .note-container {
            background-color: #f0fdf4;
            border: 1px solid #dcfce7;
            border-radius: 8px;
            padding: 12px;
            margin-top: 30px;
        }
        .note-title {
            font-weight: bold;
            color: #166534;
            margin-bottom: 5px;
            font-size: 11px;
        }
        .note-content {
            color: #15803d;
            font-size: 10px;
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

    <div class="report-title">Laporan Pelanggan Setia<br><span style="font-size: 11px; font-weight: normal; text-transform: none; color: #6b7280;">Pelanggan paling sering berkunjung (diurutkan berdasarkan total kunjungan selesai)</span></div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;" class="text-center">Peringkat</th>
                <th style="width: 45%;">Nama Pelanggan</th>
                <th style="width: 25%;">No. Telepon</th>
                <th style="width: 15%;" class="text-center">Total Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggan as $index => $p)
                <tr class="{{ $index < 3 ? 'top-rank' : '' }}">
                    <td class="text-center font-bold">
                        @if($index == 0)
                            <span class="medal">🥇</span> 1
                        @elseif($index == 1)
                            <span class="medal">🥈</span> 2
                        @elseif($index == 2)
                            <span class="medal">🥉</span> 3
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>
                    <td class="font-bold">{{ $p->nama }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td class="text-center font-bold" style="color: #4f46e5; font-size: 12px;">{{ $p->total_kunjungan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color: #6b7280;">Belum ada data pelanggan dengan transaksi selesai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="note-container">
        <div class="note-title">Saran Tindakan:</div>
        <div class="note-content">
            Gunakan data pelanggan setia di atas untuk memberikan promosi khusus, diskon, atau layanan prioritas guna menjaga loyalitas mereka terhadap {{ $profil->nama_toko ?? 'AutoClean' }}.
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} {{ $profil->nama_toko ?? 'AutoClean' }}. Laporan ini dibuat secara otomatis oleh sistem.
    </div>
</body>
</html>
