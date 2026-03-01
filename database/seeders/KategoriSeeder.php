<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Motor Kecil', 'deskripsi' => 'Motor bebek, matic kecil'],
            ['nama' => 'Motor Besar', 'deskripsi' => 'Motor sport, matic besar (NMAX, PCX, dll)'],
            ['nama' => 'Mobil', 'deskripsi' => 'Semua jenis mobil'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Helm, karpet, dll'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
