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
       Schema::create('kelas', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('nama_kelas', 255);
    $table->text('deskripsi');
    $table->enum('jenis_kelas', ['reguler', 'private']);
    $table->decimal('biaya', 8, 0);
    $table->timestamps();
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
