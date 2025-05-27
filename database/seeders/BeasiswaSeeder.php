<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;

class BeasiswaSeeder extends Seeder
{
    public function run()
    {
        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Prestasi Akademik',
            'deskripsi' => 'Beasiswa untuk mahasiswa dengan prestasi akademik yang outstanding',
            'jumlah_dana' => 10000000,
            'kuota_total' => 20,
            'kuota_tersedia' => 20,
            'persyaratan' => 'IPK minimal 3.5, Aktif organisasi, Surat rekomendasi dosen',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(2),
            'tingkat_pendidikan_target' => 'S1',
            'minimal_ipk' => 3.50
        ]);

        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Kurang Mampu',
            'deskripsi' => 'Beasiswa untuk mahasiswa dari keluarga kurang mampu',
            'jumlah_dana' => 7500000,
            'kuota_total' => 50,
            'kuota_tersedia' => 50,
            'persyaratan' => 'Surat keterangan tidak mampu, IPK minimal 3.0',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(3),
            'tingkat_pendidikan_target' => 'S1',
            'minimal_ipk' => 3.00
        ]);

        Beasiswa::create([
            'nama_beasiswa' => 'Beasiswa Riset Pascasarjana',
            'deskripsi' => 'Beasiswa untuk mahasiswa pascasarjana yang melakukan riset',
            'jumlah_dana' => 15000000,
            'kuota_total' => 10,
            'kuota_tersedia' => 10,
            'persyaratan' => 'Proposal riset, IPK S1 minimal 3.7, Publikasi ilmiah',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonth(),
            'tingkat_pendidikan_target' => 'S2',
            'minimal_ipk' => 3.70
        ]);
    }
}