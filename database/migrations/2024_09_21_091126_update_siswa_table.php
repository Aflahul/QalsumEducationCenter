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
        Schema::table('siswa', function (Blueprint $table) {
            // Menghapus kolom username
            $table->dropColumn('username');

            // Menambahkan kolom foto
            $table->string('foto')->nullable()->after('jenis_kelamin');
        });
    }

    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Mengembalikan kolom username
            $table->string('username')->unique()->after('id');

            // Menghapus kolom foto
            $table->dropColumn('foto');
        });
    }
};
