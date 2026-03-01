<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{

    protected $table = 'pembayaran';

    protected $fillable = [
        'transaksi_id',
        'total_bayar',
        'metode_pembayaran',
        'status_pembayaran',
        'waktu_bayar',
    ];

    protected $casts = [
        'waktu_bayar' => 'datetime',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
