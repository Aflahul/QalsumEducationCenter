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
        Schema::create('penilaian_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_kelas_id')->constrained('pendaftaran_kelas')->onDelete('cascade');
            $table->decimal('nilai_akhir', 5, 2); // Nilai akhir kelas
            $table->string('grade', 2); // Grade, misalnya A, B, C
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_kelas');
    }
};
