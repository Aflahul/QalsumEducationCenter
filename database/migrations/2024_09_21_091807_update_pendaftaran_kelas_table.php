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
        Schema::table('pendaftaran_kelas', function (Blueprint $table) {
            // Menghapus kolom jumlah_bayar
            $table->dropColumn('jumlah_bayar');
        });
    }

    public function down()
    {
        Schema::table('pendaftaran_kelas', function (Blueprint $table) {
            // Menambahkan kembali kolom jumlah_bayar
            $table->decimal('jumlah_bayar', 8, 0)->after('sisa_bayar'); // Sesuaikan posisi jika perlu
        });
    }
};
