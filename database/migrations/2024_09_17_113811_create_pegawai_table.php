<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->string('nama');
            $table->string('username')->unique();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('kontak_hp');
            $table->string('pendidikan_terakhir');
            $table->string('foto')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jabatan');
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
