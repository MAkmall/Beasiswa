<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Metode untuk memeriksa apakah pengguna adalah peserta
    public function adalahPeserta()
    {
        // Misalnya, kita anggap kolom 'role' di tabel users menyimpan informasi peran pengguna
        return $this->role === 'peserta'; // Sesuaikan dengan logika peran Anda
    }

    // Kolom lainnya dan hubungan model dapat ditambahkan di sini
}
