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
        Schema::create('penilaian_kelas', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('id_siswa');
    $table->unsignedBigInteger('id_kelas');
    $table->unsignedBigInteger('id_materi');
    $table->integer('nilai');
    $table->text('catatan')->nullable();
    $table->timestamps();

    $table->foreign('id_siswa')->references('id')->on('siswa')->onUpdate('restrict')->onDelete('cascade');
    $table->foreign('id_kelas')->references('id')->on('kelas')->onUpdate('restrict')->onDelete('cascade');
    $table->foreign('id_materi')->references('id')->on('materi')->onUpdate('restrict')->onDelete('cascade');
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
