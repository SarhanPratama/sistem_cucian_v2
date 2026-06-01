<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\ProfilToko;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicBookingController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
            $profil = ProfilToko::first();

        return view('booking.create', compact('kategoris', 'profil'));
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

        $profil = ProfilToko::first();
        $estimasi = Carbon::parse($request->estimasi_tiba);

        $isWeekend = $estimasi->isWeekend();
        $jamBukaStr = $isWeekend ? $profil->jam_buka_akhir_pekan : $profil->jam_buka_pekan;

        // Pengecekan sederhana berasumsi format "08.00 - 20.00" atau "08:00 - 20:00"
        if ($jamBukaStr) {
            $parts = explode('-', $jamBukaStr);
            if (count($parts) == 2) {
                $buka = date('H:i', strtotime(trim($parts[0])));
                $tutup = date('H:i', strtotime(trim($parts[1])));

                $waktuTiba = $estimasi->format('H:i');

                if ($waktuTiba < $buka || $waktuTiba > $tutup) {
                    return back()->withInput()->with('error', "Maaf, jam booking ({$waktuTiba}) berada di luar jam operasional kami pada hari tersebut. Jam operasional: {$jamBukaStr}.");
                }
            }
        }

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

    public function checkStatus()
    {
        $antrianAktif = Transaksi::with('layanan.kategori', 'pelanggan')
            ->whereIn('status', ['menunggu', 'diproses'])
            ->orderByRaw("CASE WHEN status = 'diproses' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'asc')
            ->get();
        $profil = ProfilToko::first();

        return view('booking.status', compact('antrianAktif', 'profil'));
    }
}
