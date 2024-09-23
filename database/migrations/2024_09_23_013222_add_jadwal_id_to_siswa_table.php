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
        Schema::table('siswa', function (Blueprint $table) {
            // Pastikan tipe data dan indeks sudah benar
            // $table->unsignedBigInteger('jadwal')->nullable()->after('kolom_lain'); // Ganti 'kolom_lain' dengan kolom yang sesuai

            // Menambahkan foreign key
            $table->foreign('jadwal')
                ->references('id')->on('jadwal')
                // ->onDelete('set null')
                ; // Pastikan 'set null' sesuai dengan logika Anda
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
          
            // Menghapus foreign key
            $table->dropForeign(['jadwal']);
        });
    }
};
