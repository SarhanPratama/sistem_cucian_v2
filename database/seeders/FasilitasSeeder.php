<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            [
                'judul' => 'Free Wi-Fi',
                'deskripsi' => 'Koneksi internet super cepat untuk tetap produktif atau streaming favorit Anda.',
                'ikon' => 'fas fa-wifi',
            ],
            [
                'judul' => 'Ruang Ber-AC',
                'deskripsi' => 'Ruang tunggu nyaman dengan AC untuk kenyamanan maksimal Anda.',
                'ikon' => 'fas fa-snowflake',
            ],
            [
                'judul' => 'Kopi & Snack Gratis',
                'deskripsi' => 'Nikmati kopi, teh, dan snack gratis selama menunggu kendaraan selesai dicuci.',
                'ikon' => 'fas fa-coffee',
            ],
            [
                'judul' => 'Ruang Ibadah / Musholla',
                'deskripsi' => 'Fasilitas musholla yang bersih dan nyaman untuk ibadah Anda.',
                'ikon' => 'fas fa-mosque',
            ],
            [
                'judul' => 'Toilet Bersih',
                'deskripsi' => 'Toilet yang selalu terjaga kebersihannya dengan standar kebersihan tinggi.',
                'ikon' => 'fas fa-restroom',
            ],
            [
                'judul' => 'TV & Majalah',
                'deskripsi' => 'Hiburan berupa TV dan koleksi majalah otomotif untuk mengisi waktu tunggu.',
                'ikon' => 'fas fa-tv',
            ]
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::create($item);
        }
    }
}
