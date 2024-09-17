<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_aspek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aspek_id');
            $table->string('nama_sub_aspek');
            $table->decimal('nilai', 5, 2);
            $table->timestamps();

            $table->foreign('aspek_id')->references('id')->on('aspek')->onDelete('cascade');
        });
    }

    /**
     * Run the migrations.
     */
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_aspek');
    }
};
