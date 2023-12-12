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

        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->integer('nip');
            $table->string('nama');
            $table->dateTime('tanggal_Lahir');
            $table->text('Nomor_Telepon');
            $table->text('Email');
            $table->text('Password');
            $table->timestamps('');
        });

        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_rm');
            $table->string('nama');
            $table->dateTime('Tanggal_Lahir');
            $table->text('Nomor_Telepon');
            $table->text('Alamat');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('poli');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('pasien');
    }
}

?>
