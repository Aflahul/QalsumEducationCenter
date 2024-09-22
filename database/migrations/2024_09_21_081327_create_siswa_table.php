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
        $table->id();
        $table->string('nama', 100);
        $table->string('username', 50)->unique(); // Menambahkan unique constraint
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->string('kontak_hp', 15);
        $table->string('pendidikan_terakhir', 50);
        $table->string('jenis_kelamin', 10);
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
