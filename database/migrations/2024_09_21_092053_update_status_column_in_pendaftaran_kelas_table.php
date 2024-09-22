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
        Schema::table('pendaftaran_kelas', function (Blueprint $table) {
            // Mengubah kolom status dari tinyint(1) ke varchar(20)
            $table->string('status', 20)->change();
        });
    }

    public function down()
    {
        Schema::table('pendaftaran_kelas', function (Blueprint $table) {
            // Mengubah kembali kolom status ke tinyint(1)
            $table->tinyInteger('status')->change();
        });
    }
};
