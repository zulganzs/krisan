<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'tiket_id',
        'id_pelanggan',
        'jenis_masalah',
        'foto_bukti',
        'deskripsi',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }
}
