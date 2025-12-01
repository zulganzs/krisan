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
        Schema::create('golongan_tarifs', function (Blueprint $table) {
            $table->string('kode_golongan')->primary();
            $table->string('deskripsi');
            $table->decimal('harga_per_m3', 10, 2);
            $table->decimal('beban_tetap', 10, 2); // Maintenance fee
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan_tarifs');
    }
};
