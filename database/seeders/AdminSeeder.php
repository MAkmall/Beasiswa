<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin default
        Pengguna::create([
            'nama' => 'Administrator',
            'email' => 'admin@beasiswa.com',
            'kata_sandi' => Hash::make('admin123'),
            'peran' => 'admin',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Admin No. 1',
            'tanggal_lahir' => '1990-01-01'
        ]);

        // Buat beberapa peserta contoh
        Pengguna::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'peserta',
            'telepon' => '081234567891',
            'alamat' => 'Jl. Peserta No. 1',
            'tanggal_lahir' => '2000-05-15',
            'tingkat_pendidikan' => 'S1',
            'universitas' => 'Universitas Muhammadiyah Kalimantan Timur',
            'jurusan' => 'Teknik Informatika',
            'ipk' => 3.75
        ]);

        Pengguna::create([
            'nama' => 'Sari Dewi',
            'email' => 'sari@email.com',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'peserta',
            'telepon' => '081234567892',
            'alamat' => 'Jl. Peserta No. 2',
            'tanggal_lahir' => '1999-12-20',
            'tingkat_pendidikan' => 'S1',
            'universitas' => 'Universitas Muhammadiyah Kalimantan Timur',
            'jurusan' => 'Teknik Elektro',
            'ipk' => 3.85
        ]);
    }
}