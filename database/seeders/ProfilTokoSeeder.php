<?php

namespace Database\Seeders;

use App\Models\ProfilToko;
use Illuminate\Database\Seeder;

class ProfilTokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilToko::create([
            'nama_toko' => 'AutoClean',
            'hero_title' => 'Kilau Sempurna untuk Kendaraan Kesayangan Anda',
            'hero_subtitle' => 'Cuci Cepat, Bersih Detail, Harga Bersahabat',
            'tentang_kami' => 'Sejak tahun 2018, AutoClean hadir dengan misi memberikan perawatan kendaraan yang tidak sekadar "asal siram", tetapi detail dan menyeluruh. Kami percaya setiap kendaraan adalah investasi yang layak mendapat perawatan terbaik.',
            'alamat' => 'Jl. Sudirman No. 123, Pekanbaru, Riau 28116',
            'no_telepon' => '+62 761 123 4567',
            'email' => 'info@autoclean.co.id',
            'whatsapp' => '+62 812 3456 7890',
            'jam_buka_pekan' => '08.00 - 20.00',
            'jam_buka_akhir_pekan' => '07.00 - 21.00',
            'url_map' => 'https://maps.app.goo.gl/1zSUb4BLm7WDzvpB6',
            'url_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6668089856755!2d101.44370431475395!3d0.5070693996396634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab80690ee7b1%3A0x9105esterol!2sPekanbaru%2C%20Riau!5e0!3m2!1sen!2sid!4v1234567890'
            ]);
    }
}
