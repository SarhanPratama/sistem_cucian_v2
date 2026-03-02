<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicBookingController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('booking.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'plat_nomor' => 'required|string|max:20',
            'layanan_id' => 'required|exists:layanan,id',
            'estimasi_tiba' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string',
        ]);

        // Cari pelanggan berdasarkan no_hp, jika tidak ada buat baru
        $pelanggan = Pelanggan::firstOrCreate(
            ['no_hp' => $request->no_hp],
            ['nama' => $request->nama, 'alamat' => '-']
        );

        // Generate Nomor Antrian
        $tanggal = Carbon::now()->format('Ymd');
        $count = Transaksi::whereDate('created_at', Carbon::today())->count() + 1;
        $nomor_antrian = 'TRX-' . $tanggal . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        // Buat Transaksi
        $transaksi = Transaksi::create([
            'pelanggan_id' => $pelanggan->id,
            'layanan_id' => $request->layanan_id,
            'plat_nomor' => $request->plat_nomor,
            'estimasi_tiba' => $request->estimasi_tiba,
            'nomor_antrian' => $nomor_antrian,
            'status' => 'menunggu',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('booking.success', $transaksi->nomor_antrian);
    }

    public function success($nomor_antrian)
    {
        $transaksi = Transaksi::with('layanan', 'pelanggan')->where('nomor_antrian', $nomor_antrian)->firstOrFail();
        return view('booking.success', compact('transaksi'));
    }

    public function checkStatus(Request $request)
    {
        $transaksi = null;
        $search = $request->query('search');

        if ($search) {
            $transaksi = Transaksi::with('layanan', 'pelanggan')
                ->where('nomor_antrian', $search)
                ->orWhere('plat_nomor', $search)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('booking.status', compact('transaksi', 'search'));
    }
}
