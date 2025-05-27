<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->foreignId('id_beasiswa')->constrained('beasiswa');
            $table->text('alasan_mendaftar');
            $table->string('berkas_transkrip')->nullable();
            $table->string('berkas_cv')->nullable();
            $table->string('berkas_surat_rekomendasi')->nullable();
            $table->enum('status_pendaftaran', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamp('tanggal_keputusan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_beasiswa');
    }
};