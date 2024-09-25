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
    $table->bigIncrements('id');
    $table->unsignedBigInteger('id_siswa')->nullable();
    $table->decimal('angsuran1', 10, 0)->nullable();
    $table->decimal('angsuran2', 10, 0)->nullable();
    $table->decimal('sisa_pembayaran', 10, 0)->nullable();
    $table->decimal('biaya_total', 10, 0)->nullable();
    $table->string('status', 20);
    $table->timestamps();

    $table->foreign('id_siswa')->references('id')->on('siswa')->onUpdate('restrict')->onDelete('cascade');
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
