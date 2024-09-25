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
        Schema::create('nilai', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('id_siswa');
    $table->unsignedBigInteger('id_kelas');
    $table->integer('nilai_total')->nullable();
    $table->decimal('nilai_rata_rata', 3, 0)->nullable();
    $table->string('grade', 2)->nullable();
    $table->timestamps();

    $table->foreign('id_siswa')->references('id')->on('siswa')->onUpdate('restrict')->onDelete('cascade');
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
