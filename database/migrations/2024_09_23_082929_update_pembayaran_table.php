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
    Schema::table('pembayaran', function (Blueprint $table) {
        // Menambahkan kolom baru
        $table->unsignedBigInteger('id_siswa')->after('id')->nullable();
        $table->decimal('angsuran1', 10, 0)->nullable()->after('jumlah_bayar');
        $table->decimal('angsuran2', 10, 0)->nullable()->after('angsuran1');
        $table->decimal('sisa_pembayaran', 10, 0)->nullable()->after('angsuran2');
        $table->decimal('biaya_total', 10, 0)->nullable()->after('sisa_pembayaran');
        $table->dropForeign('pembayaran_pendaftaran_kelas_id_foreign');

        // Menghapus kolom bukti_pembayaran, jumlah_bayar, dan pendaftaran_kelas_id
        $table->dropColumn(['bukti_pembayaran', 'jumlah_bayar', 'pendaftaran_kelas_id']);
        // Menambahkan foreign key untuk id_siswa
        $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('pembayaran', function (Blueprint $table) {
        // Menghapus kolom baru
        $table->dropForeign(['id_siswa']);
        $table->dropColumn(['id_siswa', 'angsuran1', 'angsuran2', 'sisa_pembayaran', 'biaya_total']);
        $table->unsignedBigInteger('pendaftaran_kelas_id')->nullable();
        $table->decimal('jumlah_bayar', 10, 2)->nullable();
        $table->string('bukti_pembayaran')->nullable();

        // Mengembalikan foreign key pendaftaran_kelas_id
        $table->foreign('pendaftaran_kelas_id')->references('id')->on('pendaftaran_kelas')->onDelete('cascade');
   
    });
}

};
