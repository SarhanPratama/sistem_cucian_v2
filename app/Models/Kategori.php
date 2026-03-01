<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama', 'deskripsi'];

    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }
}
