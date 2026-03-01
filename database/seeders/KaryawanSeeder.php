<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = [
            [
                'nama' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Agus Pratama',
                'no_hp' => '081234567891',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Dina Amelia',
                'no_hp' => '081234567892',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Citra Lestari',
                'no_hp' => '081234567893',
                'status' => 'aktif',
            ]
        ];

        foreach ($karyawans as $k) {
            Karyawan::create($k);
        }
    }
}
