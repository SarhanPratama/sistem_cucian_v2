<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::with('kategori')->get();
        return view('layanan.index', compact('layanan'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('layanan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data["is_active"] = $request->has("is_active");
        Layanan::create($data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $kategoris = Kategori::all();
        return view('layanan.edit', compact('layanan', 'kategoris'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data["is_active"] = $request->has("is_active");
        $layanan->update($data);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        // Pengecekan aman, cegah hapus jika ada transaksi
        $transaksiCount = \App\Models\Transaksi::where('layanan_id', $layanan->id)->count();
        if ($transaksiCount > 0) {
            return redirect()->route('layanan.index')->with('error', 'Gagal dihapus: Layanan ini sudah pernah dipakai di ' . $transaksiCount . ' transaksi. Silakan nonaktifkan layanan jika tidak dipakai lagi.');
        }

        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    public function getByKategori($kategori_id)
    {
        $layanan = Layanan::where('kategori_id', $kategori_id)
                          ->where('is_active', true)
                          ->get();
        return response()->json($layanan);
    }
}
