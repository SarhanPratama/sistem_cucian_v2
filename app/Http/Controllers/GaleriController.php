<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'foto_sebelum' => 'nullable|image',
            'foto_sesudah' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_sebelum')) {
            $data['foto_sebelum'] = $request->file('foto_sebelum')->store('galeri', 'public');
        }
        if ($request->hasFile('foto_sesudah')) {
            $data['foto_sesudah'] = $request->file('foto_sesudah')->store('galeri', 'public');
        }

        Galeri::create($data);
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required',
            'foto_sebelum' => 'nullable|image',
            'foto_sesudah' => 'nullable|image',
        ]);

        $data = $request->except(['foto_sebelum', 'foto_sesudah']);

        if ($request->hasFile('foto_sebelum')) {
            if ($galeri->foto_sebelum) Storage::disk('public')->delete($galeri->foto_sebelum);
            $data['foto_sebelum'] = $request->file('foto_sebelum')->store('galeri', 'public');
        }
        
        if ($request->hasFile('foto_sesudah')) {
            if ($galeri->foto_sesudah) Storage::disk('public')->delete($galeri->foto_sesudah);
            $data['foto_sesudah'] = $request->file('foto_sesudah')->store('galeri', 'public');
        }

        $galeri->update($data);
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto_sebelum) Storage::disk('public')->delete($galeri->foto_sebelum);
        if ($galeri->foto_sesudah) Storage::disk('public')->delete($galeri->foto_sesudah);

        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
