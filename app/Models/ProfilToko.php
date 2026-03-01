<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilToko extends Model
{
    protected $table = 'profil_toko';
    protected $fillable = [
        'nama_toko',
        'logo',
        'favicon',
        'hero_title',
        'hero_subtitle',
        'tentang_kami',
        'alamat',
        'no_telepon',
        'email',
        'whatsapp',
        'jam_buka_pekan',
        'jam_buka_akhir_pekan',
        'url_map',
        'url_embed',
        'facebook',
        'instagram'
    ];
}
