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
        Schema::create('pegawai', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('pegawai_id', 255);
    $table->string('nama', 255);
    $table->string('username', 255);
    $table->date('tanggal_lahir');
    $table->string('alamat', 255);
    $table->string('jabatan', 20);
    $table->string('kontak_hp', 255);
    $table->string('pendidikan_terakhir', 255);
    $table->string('foto', 255)->nullable();
    $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
    $table->timestamps();
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
