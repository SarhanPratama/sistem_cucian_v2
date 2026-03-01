<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['nama', 'no_hp', 'status', 'foto'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
