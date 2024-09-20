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
            $table->id(); // Kolom id auto-increment
            $table->string('pegawai_id', 20)->unique(); // pegawai_id sebagai unique
            $table->string('nama');
            $table->string('username')->unique();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('kontak_hp');
            $table->string('pendidikan_terakhir');
            $table->string('foto')->nullable();
            $table->string('jenis_kelamin');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
