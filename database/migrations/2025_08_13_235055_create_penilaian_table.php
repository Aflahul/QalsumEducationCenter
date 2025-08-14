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
    Schema::create('penilaian', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
        $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
        $table->integer('nilai')->nullable();
        $table->string('grade', 2)->nullable(); // misal: A, B, C
        $table->string('predikat')->nullable(); // misal: "Sangat Baik"
        $table->timestamps();
    });
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
