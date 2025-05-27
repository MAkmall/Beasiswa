<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_terverifikasi_pada')->nullable();
            $table->string('kata_sandi');
            $table->enum('peran', ['admin', 'peserta'])->default('peserta');
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tingkat_pendidikan')->nullable();
            $table->string('universitas')->nullable();
            $table->string('jurusan')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};