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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_kelas_id')->constrained('pendaftaran_kelas')->onDelete('cascade');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->boolean('status')->default(false); // Status pembayaran
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
