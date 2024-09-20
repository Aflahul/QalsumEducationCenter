<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Foreign key ke pegawai
            $table->string('password');
            $table->string('nama');
            $table->enum('role', ['admin', 'instruktur', 'siswa']);
            $table->timestamps();

            // Relasi foreign key ke tabel pegawai dengan cascade delete
            $table->foreign('username')->references('username')->on('pegawai')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
