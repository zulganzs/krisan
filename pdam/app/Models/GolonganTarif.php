<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GolonganTarif extends Model
{
    protected $primaryKey = 'kode_golongan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_golongan',
        'deskripsi',
        'harga_per_m3',
        'beban_tetap',
    ];
}
