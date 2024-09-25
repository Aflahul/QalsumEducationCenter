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
        Schema::create('materi', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('nama_materi', 255);
    $table->text('deskripsi')->nullable();
    $table->unsignedBigInteger('id_kelas');
    $table->timestamps();

    $table->foreign('id_kelas')->references('id')->on('kelas')->onUpdate('restrict')->onDelete('cascade');
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
