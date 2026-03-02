<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'layanan', 'karyawan'])->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $kategoris = Kategori::all();
        return view('transaksi.create', compact('pelanggan', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'layanan_id' => 'required|exists:layanan,id',
            'plat_nomor' => 'required|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        // Generate Nomor Antrian (Format: TRX-YYYYMMDD-XXX)
        $today = Carbon::now()->format('Ymd');
        $lastTransaksi = Transaksi::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        $urutan = $lastTransaksi ? (int)substr($lastTransaksi->nomor_antrian, -3) + 1 : 1;
        $nomorAntrian = 'TRX-' . $today . '-' . str_pad($urutan, 3, '0', STR_PAD_LEFT);

        Transaksi::create([
            'nomor_antrian' => $nomorAntrian,
            'pelanggan_id' => $request->pelanggan_id,
            'layanan_id' => $request->layanan_id,
            'plat_nomor' => strtoupper($request->plat_nomor),
            'estimasi_tiba' => now(),
            'status' => 'menunggu',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat. Nomor Antrian: ' . $nomorAntrian);
    }

    public function edit(Transaksi $transaksi)
    {
        if (in_array($transaksi->status, ['selesai', 'dibatalkan'])) {
            return redirect()->route('transaksi.index')
                ->with('error', 'Transaksi dengan status selesai atau dibatalkan tidak bisa diubah lagi.');
        }

        $transaksi->load('pelanggan', 'layanan.kategori');
        $karyawan = Karyawan::where('status', 'aktif')->get();
        return view('transaksi.edit', compact('transaksi', 'karyawan'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('pelanggan', 'layanan.kategori', 'karyawan');
        return view('transaksi.show', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
            'karyawan_id' => 'nullable|exists:karyawan,id',
            'metode_pembayaran' => 'nullable|in:tunai,qris,transfer',
        ]);

        if (in_array($transaksi->status, ['selesai', 'dibatalkan'])) {
            return redirect()->route('transaksi.index')
                ->with('error', 'Status transaksi ini sudah final dan tidak bisa diubah.');
        }

        if ($request->status === 'dibatalkan' && $transaksi->status !== 'menunggu') {
            return back()->withErrors([
                'status' => 'Transaksi hanya bisa dibatalkan saat masih berstatus menunggu.'
            ])->withInput();
        }

        // Jika status diproses atau selesai, karyawan harus diisi
        if (in_array($request->status, ['diproses', 'selesai']) && empty($request->karyawan_id)) {
            return back()->withErrors(['karyawan_id' => 'Karyawan harus dipilih jika status diproses atau selesai.'])->withInput();
        }

        $transaksi->update([
            'status' => $request->status,
            'karyawan_id' => $request->karyawan_id,
        ]);

        // Jika status diubah menjadi selesai, arahkan ke halaman POS (Pembayaran)
        // if ($request->status === 'selesai') {
        //     $existingPembayaran = \App\Models\Pembayaran::where('transaksi_id', $transaksi->id)->first();

        //     // Jika belum dibayar, arahkan ke form pembayaran
        //     if (!$existingPembayaran || $existingPembayaran->status_pembayaran === 'belum_dibayar') {
        //         return redirect()->route('pembayaran.create', ['transaksi_id' => $transaksi->id])
        //             ->with('success', 'Status transaksi selesai. Silakan proses pembayaran.');
        //     }
        // }

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'menunggu') {
            return redirect()->route('transaksi.index')
                ->with('error', 'Hanya transaksi berstatus menunggu yang boleh dihapus (untuk koreksi input).');
        }

        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
