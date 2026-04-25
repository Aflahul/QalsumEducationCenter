<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pendaftaran')->constrained('pendaftaran')->onDelete('cascade');
            $table->integer('angsuran_ke'); // 1 atau 2
            $table->decimal('jumlah', 12, 2);
            $table->decimal('biaya_total', 12, 2)->nullable();
            $table->decimal('sisa_pembayaran', 12, 2)->nullable();
            $table->date('tanggal_bayar');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
