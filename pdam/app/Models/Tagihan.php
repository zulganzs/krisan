<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'meter_awal',
        'meter_akhir',
        'total_tagihan',
        'status_bayar',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }
}
