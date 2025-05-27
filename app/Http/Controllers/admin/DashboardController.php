<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PendaftaranBeasiswa;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBeasiswa = Beasiswa::count();
        $beasiswaAktif = Beasiswa::aktif()->count();
        $totalPeserta = Pengguna::where('peran', 'peserta')->count();
        $pendaftaranMenunggu = PendaftaranBeasiswa::menunggu()->count();
        $pendaftaranDiterima = PendaftaranBeasiswa::diterima()->count();
        $pendaftaranDitolak = PendaftaranBeasiswa::ditolak()->count();

        // Data untuk chart
        $beasiswaTerbaru = Beasiswa::latest()->take(5)->get();
        $pendaftaranTerbaru = PendaftaranBeasiswa::with(['pengguna', 'beasiswa'])
            ->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalBeasiswa',
            'beasiswaAktif', 
            'totalPeserta',
            'pendaftaranMenunggu',
            'pendaftaranDiterima',
            'pendaftaranDitolak',
            'beasiswaTerbaru',
            'pendaftaranTerbaru'
        ));
    }
}