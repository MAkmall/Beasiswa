<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_beasiswa');
            $table->text('deskripsi');
            $table->decimal('jumlah_dana', 15, 2);
            $table->integer('kuota_total');
            $table->integer('kuota_tersedia');
            $table->text('persyaratan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('tingkat_pendidikan_target');
            $table->decimal('minimal_ipk', 3, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
};