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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id(); // id (bigint)
            $table->unsignedBigInteger('id_siswa'); // Foreign key ke tabel siswa
            $table->string('nomor_sertifikat'); // Nomor sertifikat
            $table->string('nama_kelas'); // Nama kelas yang diikuti
            $table->text('daftar_nilai'); // Daftar nilai setiap materi
            $table->string('grade'); // Nilai akhir/Grade
            $table->date('tanggal_penyelesaian'); // Tanggal penyelesaian kelas
            $table->timestamps(); // created_at, updated_at

            // Menambahkan foreign key constraint
            $table->foreign('id_siswa')->references('id')->on('siswa')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
