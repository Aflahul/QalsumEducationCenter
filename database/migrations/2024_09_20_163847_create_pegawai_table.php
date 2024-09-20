<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_id')->unique();
            $table->string('nama')->unique();
            $table->string('username')->unique(); // Kolom yang akan berelasi ke pengguna
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('kontak_hp');
            $table->string('jabatan');
            $table->string('pendidikan_terakhir');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
