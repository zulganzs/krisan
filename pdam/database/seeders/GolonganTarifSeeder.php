<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganTarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GolonganTarif::create([
            'kode_golongan' => 'R1',
            'deskripsi' => 'Rumah Tangga A',
            'harga_per_m3' => 2500,
            'beban_tetap' => 10000,
        ]);

        \App\Models\GolonganTarif::create([
            'kode_golongan' => 'R2',
            'deskripsi' => 'Rumah Tangga B',
            'harga_per_m3' => 3500,
            'beban_tetap' => 15000,
        ]);

        \App\Models\GolonganTarif::create([
            'kode_golongan' => 'N1',
            'deskripsi' => 'Niaga Kecil',
            'harga_per_m3' => 5000,
            'beban_tetap' => 25000,
        ]);
    }
}
