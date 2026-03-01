<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'nama' => 'Cuci Motor Bebek/Matic Kecil',
                'harga' => 15000,
                'kategori_id' => 1, // Motor Kecil
                'deskripsi' => 'Cuci bersih bodi, mesin, dan semir ban untuk motor ukuran kecil.',
            ],
            [
                'nama' => 'Cuci Motor Sport/Matic Besar',
                'harga' => 20000,
                'kategori_id' => 2, // Motor Besar
                'deskripsi' => 'Cuci bersih bodi, mesin, dan semir ban untuk motor ukuran besar (NMAX, PCX, Ninja, dll).',
            ],
            [
                'nama' => 'Cuci Mobil Standar',
                'harga' => 40000,
                'kategori_id' => 3, // Mobil
                'deskripsi' => 'Cuci bodi luar, vakum interior, dan semir ban.',
            ],
            [
                'nama' => 'Cuci Mobil Premium + Wax',
                'harga' => 60000,
                'kategori_id' => 3, // Mobil
                'deskripsi' => 'Cuci bodi luar, vakum interior, semir ban, dan aplikasi wax pelindung cat.',
            ],
            [
                'nama' => 'Cuci Helm',
                'harga' => 15000,
                'kategori_id' => 4, // Lainnya
                'deskripsi' => 'Cuci bersih luar dalam helm dan pewangi.',
            ],
            [
                'nama' => 'Cuci Karpet Mobil',
                'harga' => 25000,
                'kategori_id' => 4, // Lainnya
                'deskripsi' => 'Cuci bersih karpet dasar mobil.',
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
