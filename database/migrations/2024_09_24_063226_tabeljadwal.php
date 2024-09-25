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
        Schema::create('jadwal', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('id_kelas');
    $table->unsignedBigInteger('id_pegawai');
    $table->string('nama_jadwal', 255);
    $table->string('hari', 255);
    $table->time('jam_mulai');
    $table->time('jam_selesai');
    $table->timestamps();

    $table->foreign('id_kelas')->references('id')->on('kelas')->onUpdate('restrict')->onDelete('cascade');
    $table->foreign('id_pegawai')->references('id')->on('pegawai')->onUpdate('restrict')->onDelete('cascade');
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
