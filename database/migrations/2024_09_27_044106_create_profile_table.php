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
    Schema::create('profil', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lembaga');  // Institution name
        $table->string('alamat');        // Institution address
        $table->string('telepon');       // Phone number
        $table->string('email');         // Email address
        $table->string('website')->nullable();  // Website (optional)
        $table->string('logo')->nullable();     // Logo (optional)
        $table->text('deskripsi')->nullable();  // Description (optional)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
