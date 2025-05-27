<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'peran',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'tingkat_pendidikan',
        'universitas',
        'jurusan',
        'ipk'
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    // Override method untuk autentikasi Laravel
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    // Relasi dengan pendaftaran beasiswa
    public function pendaftaranBeasiswa()
    {
        return $this->hasMany(PendaftaranBeasiswa::class, 'id_pengguna');
    }

    // Cek apakah pengguna adalah admin
    public function adalahAdmin()
    {
        return $this->peran === 'admin';
    }

    // Cek apakah pengguna adalah peserta
    public function adalahPeserta()
    {
        return $this->peran === 'peserta';
    }
}