<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jadwal');
            $table->string('nama_kelas'); // Foreign key ke tabel kelas
            $table->string('jalur');
            $table->string('instruktur'); // Foreign key ke tabel pegawai
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();

            // Relasi foreign key ke tabel kelas
            $table->foreign('nama_kelas')->references('nama_kelas')->on('kelas')->onDelete('cascade');

            // Relasi foreign key ke tabel pegawai (instruktur)
            $table->foreign('instruktur')->references('nama')->on('pegawai')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
