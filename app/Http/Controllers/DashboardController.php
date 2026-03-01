<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $transaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())->count();
        $transaksiMenunggu = Transaksi::where('status', 'menunggu')->count();
        $transaksiDiproses = Transaksi::where('status', 'diproses')->count();

        $pendapatanHariIni = Pembayaran::whereDate('waktu_bayar', Carbon::today())
            ->where('status_pembayaran', 'sudah_dibayar')
            ->sum('total_bayar');

        $transaksiTerbaru = Transaksi::with('pelanggan', 'layanan')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'transaksiHariIni',
            'transaksiMenunggu',
            'transaksiDiproses',
            'pendapatanHariIni',
            'transaksiTerbaru'
        ));
    }
}
