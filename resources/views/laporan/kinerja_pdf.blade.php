<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja Karyawan</title>
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
        .status-badge {
            padding: 3px 8px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 9999px;
            text-transform: uppercase;
        }
        .status-aktif {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-nonaktif {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .note-container {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 8px;
            padding: 12px;
            margin-top: 30px;
        }
        .note-title {
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
            font-size: 11px;
        }
        .note-content {
            color: #2563eb;
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

    <div class="report-title">Laporan Kinerja Karyawan<br><span style="font-size: 12px; font-weight: normal; text-transform: none;">Periode: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</span></div>

    <table>
        <thead>
            <tr>
                <th style="width: 40%;">Nama Karyawan</th>
                <th style="width: 25%;">Posisi</th>
                <th style="width: 20%;" class="text-center">Total Kendaraan Dicuci</th>
                <th style="width: 15%;">Status Karyawan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($karyawan as $k)
                <tr>
                    <td class="font-bold">{{ $k->nama }}</td>
                    <td>{{ $k->posisi }}</td>
                    <td class="text-center font-bold" style="color: #4f46e5; font-size: 12px;">{{ $k->total_cucian }}</td>
                    <td>
                        <span class="status-badge {{ $k->status == 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                            {{ $k->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color: #6b7280;">Tidak ada data karyawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="note-container">
        <div class="note-title">Catatan untuk Pemilik:</div>
        <div class="note-content">
            Data di atas menunjukkan jumlah kendaraan yang berhasil diselesaikan (status transaksi: Selesai) oleh masing-masing karyawan pada bulan dan tahun yang dipilih. Data ini dapat digunakan sebagai acuan untuk perhitungan bonus atau insentif kinerja.
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} {{ $profil->nama_toko ?? 'AutoClean' }}. Laporan ini dibuat secara otomatis oleh sistem.
    </div>
</body>
</html>
