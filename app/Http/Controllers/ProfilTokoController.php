<?php

namespace App\Http\Controllers;

use App\Models\ProfilToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilTokoController extends Controller
{
    public function edit()
    {
        $profil = ProfilToko::first();
        if (!$profil) {
            $profil = ProfilToko::create(['nama_toko' => 'AutoClean']);
        }
        return view('profil_toko.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilToko::first();

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        $data = $request->except(['logo', 'favicon']);

        if ($request->hasFile('logo')) {
            if ($profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('profil', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($profil->favicon) {
                Storage::disk('public')->delete($profil->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->route('profil_toko.edit')->with('success', 'Profil web berhasil diperbarui.');
    }
}
