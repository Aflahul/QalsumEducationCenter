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
        Schema::create('sertifikat', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pendaftaran_kelas_id')->constrained('pendaftaran_kelas')->onDelete('cascade');
    $table->string('kode_sertifikat', 50)->unique(); // Kode sertifikat yang unik
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
