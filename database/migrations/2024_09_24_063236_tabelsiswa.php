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
        Schema::create('siswa', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('nomor_siswa', 20);
    $table->string('nama', 100);
    $table->unsignedBigInteger('id_jadwal');
    $table->date('tanggal_lahir');
    $table->text('alamat');
    $table->string('kontak_hp', 15);
    $table->string('pendidikan_terakhir', 50);
    $table->string('jenis_kelamin', 10);
    $table->string('foto', 255)->nullable();
    $table->timestamps();

    $table->foreign('id_jadwal')->references('id')->on('jadwal')->onUpdate('restrict')->onDelete('restrict');
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
