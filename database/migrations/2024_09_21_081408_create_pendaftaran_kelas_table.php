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
        Schema::create('pendaftaran_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade'); // Relasi ke tabel siswa
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade'); // Relasi ke tabel jadwal
            $table->decimal('jumlah_bayar', 10, 2);
            $table->boolean('status')->default(false); // Status pembayaran
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kelas');
    }
};
