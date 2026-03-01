<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function keuangan(Request $request)
    {
        $filter = $request->query('filter', 'hari_ini');
        $bulan = $request->query('bulan', Carbon::now()->month);
        $tahun = $request->query('tahun', Carbon::now()->year);

        $query = Pembayaran::where('status_pembayaran', 'sudah_dibayar')->with('transaksi.layanan');

        $judul = 'Laporan Keuangan';

        if ($filter == 'hari_ini') {
            $query->whereDate('waktu_bayar', Carbon::today());
            $judul .= ' - Hari Ini (' . Carbon::today()->format('d M Y') . ')';
        } elseif ($filter == 'minggu_ini') {
            $query->whereBetween('waktu_bayar', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            $judul .= ' - Minggu Ini';
        } elseif ($filter == 'bulan_ini') {
            $query->whereMonth('waktu_bayar', Carbon::now()->month)
                  ->whereYear('waktu_bayar', Carbon::now()->year);
            $judul .= ' - Bulan Ini (' . Carbon::now()->format('F Y') . ')';
        } elseif ($filter == 'kustom_bulan') {
            $query->whereMonth('waktu_bayar', $bulan)
                  ->whereYear('waktu_bayar', $tahun);
            $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->format('F');
            $judul .= ' - ' . $namaBulan . ' ' . $tahun;
        }

        $pembayaran = $query->latest('waktu_bayar')->get();
        $totalPendapatan = $pembayaran->sum('total_bayar');

        return view('laporan.keuangan', compact('pembayaran', 'totalPendapatan', 'filter', 'bulan', 'tahun', 'judul'));
    }

    public function kinerja(Request $request)
    {
        $bulan = $request->query('bulan', Carbon::now()->month);
        $tahun = $request->query('tahun', Carbon::now()->year);

        $karyawan = Karyawan::withCount(['transaksi as total_cucian' => function ($query) use ($bulan, $tahun) {
            $query->where('status', 'selesai')
                  ->whereMonth('updated_at', $bulan)
                  ->whereYear('updated_at', $tahun);
        }])->get();

        return view('laporan.kinerja', compact('karyawan', 'bulan', 'tahun'));
    }

    public function pelanggan()
    {
        // Mengambil pelanggan dengan jumlah transaksi terbanyak (selesai)
        $pelanggan = Pelanggan::withCount(['transaksi as total_kunjungan' => function ($query) {
            $query->where('status', 'selesai');
        }])
        ->orderByDesc('total_kunjungan')
        ->get();

        return view('laporan.pelanggan', compact('pelanggan'));
    }
}
