<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('users')->onDelete('cascade');
            $table->string('bulan'); // e.g., "2023-10"
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->decimal('total_tagihan', 12, 2);
            $table->enum('status_bayar', ['Lunas', 'Belum Bayar'])->default('Belum Bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
