<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('password');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('kontak_hp');
            $table->string('pendidikan_terakhir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('jabatan', ['admin', 'instruktur', 'staff']);
            $table->string('bidang_keahlian');
            $table->string('status');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
