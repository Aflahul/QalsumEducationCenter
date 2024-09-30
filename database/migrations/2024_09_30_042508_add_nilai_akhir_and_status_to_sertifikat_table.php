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
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->decimal('nilai_akhir', 5, 0)->nullable()->after('grade'); // Gantilah 'some_column' dengan nama kolom yang relevan sebelumnya
            $table->enum('status', ['Belum Layak', 'Layak'])->default('Belum Layak')->after('nilai_akhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropColumn('nilai_akhir');
            $table->dropColumn('status');
        });
    }
};
