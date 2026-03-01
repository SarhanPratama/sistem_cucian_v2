<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeris = [
            [
                'judul' => 'Pencucian Toyota Fortuner',
                'deskripsi' => 'Detailing eksterior dan interior Toyota Fortuner warna hitam.',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
            ],
            [
                'judul' => 'Coating Honda Civic',
                'deskripsi' => 'Pengerjaan nano ceramic coating untuk perlindungan cat maksimal.',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
            ],
            [
                'judul' => 'Cuci Mesin Mitsubishi Pajero',
                'deskripsi' => 'Pembersihan ruang mesin (engine bay detailing) dari kerak dan oli.',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
            ]
        ];

        foreach ($galeris as $g) {
            Galeri::create($g);
        }
    }
}
