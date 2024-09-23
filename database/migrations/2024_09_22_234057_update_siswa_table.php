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
        Schema::table('siswa', function (Blueprint $table) {
        $table->unsignedBigInteger('id_pendaftaran_kelas'); // Menyimpan relasi dengan pendaftaran_kelas
        $table->string('nomor_induk_siswa')->nullable()->unique(); // Menyimpan nomor induk siswa yang berasal dari kode pendaftaran

        $table->foreign('id_pendaftaran_kelas')
            ->references('id')->on('pendaftaran_kelas')
            ->onDelete('cascade');
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
