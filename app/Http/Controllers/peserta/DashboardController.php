<?php
// app/Http/Controllers/Peserta/DashboardController.php
namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PendaftaranBeasiswa;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();
        
        $totalPendaftaran = PendaftaranBeasiswa::where('id_pengguna', $pengguna->id)->count();
        $pendaftaranMenunggu = PendaftaranBeasiswa::where('id_pengguna', $pengguna->id)
            ->menunggu()->count();
        $pendaftaranDiterima = PendaftaranBeasiswa::where('id_pengguna', $pengguna->id)
            ->diterima()->count();
        $pendaftaranDitolak = PendaftaranBeasiswa::where('id_pengguna', $pengguna->id)
            ->ditolak()->count();

        $beasiswaTersedia = Beasiswa::bisaDaftar()->count();
        
        $pendaftaranTerbaru = PendaftaranBeasiswa::where('id_pengguna', $pengguna->id)
            ->with('beasiswa')->latest()->take(5)->get();
            
        $pengumuman = Pengumuman::tampilkan()->latest()->take(5)->get();

        return view('peserta.dashboard', compact(
            'totalPendaftaran',
            'pendaftaranMenunggu',
            'pendaftaranDiterima',
            'pendaftaranDitolak',
            'beasiswaTersedia',
            'pendaftaranTerbaru',
            'pengumuman'
        ));
    }
}