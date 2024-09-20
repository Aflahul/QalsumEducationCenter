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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('pegawai_id')->references('pegawai_id')->on('pegawai')->onDelete('cascade');
            $table->dateTime('waktu');
            $table->timestamps();
            
            $table->string('pegawai_id', 20); // Menggunakan string untuk pegawai_id
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
});
    }


    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
