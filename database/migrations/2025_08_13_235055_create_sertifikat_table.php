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
    Schema::create('sertifikat', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
        $table->string('nomor_sertifikat')->unique();
        $table->date('tanggal_terbit');
        $table->decimal('nilai_rata_rata', 5, 2)->nullable();
        $table->string('predikat_kelulusan')->nullable(); // "Sangat Memuaskan"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
