<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('transaksi.pelanggan', 'transaksi.layanan')->latest()->paginate(10);
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create(Request $request)
    {
        $transaksi_id = $request->query('transaksi_id');

        // Ambil transaksi yang belum dibayar atau transaksi yang sedang dipilih
        $transaksi = Transaksi::where(function($q) use ($transaksi_id) {
            $q->whereDoesntHave('pembayaran', function ($query) {
                $query->where('status_pembayaran', 'sudah_dibayar');
            });
            if ($transaksi_id) {
                $q->orWhere('id', $transaksi_id);
            }
        })->with('pelanggan', 'layanan')->get();

        return view('pembayaran.create', compact('transaksi', 'transaksi_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'metode_pembayaran' => 'required|in:tunai,qris,transfer',
        ]);

        $transaksi = Transaksi::with('layanan')->findOrFail($request->transaksi_id);

        // Cek apakah sudah ada pembayaran untuk transaksi ini
        $existingPembayaran = Pembayaran::where('transaksi_id', $transaksi->id)->first();

        if ($existingPembayaran && $existingPembayaran->status_pembayaran == 'sudah_dibayar') {
            return redirect()->route('pembayaran.index')->with('error', 'Transaksi ini sudah dibayar.');
        }

        if ($existingPembayaran) {
            $existingPembayaran->update([
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'sudah_dibayar',
                'waktu_bayar' => now(),
            ]);
            $pembayaran = $existingPembayaran;
        } else {
            $pembayaran = Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'total_bayar' => $transaksi->layanan->harga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'sudah_dibayar',
                'waktu_bayar' => now(),
            ]);
        }

        return redirect()->route('pembayaran.show', $pembayaran->id)->with('success', 'Pembayaran berhasil diproses. Silakan cetak struk.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('transaksi.pelanggan', 'transaksi.layanan.kategori', 'transaksi.karyawan');
        return view('pembayaran.show', compact('pembayaran'));
    }
}
