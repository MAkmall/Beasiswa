<?php

// app/Http/Controllers/Peserta/BeasiswaController.php
namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PendaftaranBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Beasiswa::bisaDaftar();

        // Filter berdasarkan pencarian
        if ($request->has('cari') && $request->cari != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_beasiswa', 'like', '%' . $request->cari . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->cari . '%');
            });
        }

        // Filter berdasarkan tingkat pendidikan
        if ($request->has('tingkat_pendidikan') && $request->tingkat_pendidikan != '') {
            $query->where('tingkat_pendidikan_target', $request->tingkat_pendidikan);
        }

        $beasiswa = $query->latest()->paginate(12);
        $tingkatPendidikan = Beasiswa::aktif()
            ->distinct('tingkat_pendidikan_target')
            ->pluck('tingkat_pendidikan_target');

        // Ambil ID beasiswa yang sudah didaftar user
        $beasiswaDaftar = PendaftaranBeasiswa::where('id_pengguna', Auth::id())
            ->pluck('id_beasiswa')->toArray();

        return view('peserta.beasiswa.index', compact(
            'beasiswa', 
            'tingkatPendidikan', 
            'beasiswaDaftar'
        ));
    }

    public function show(Beasiswa $beasiswa)
    {
        // Cek apakah user sudah mendaftar beasiswa ini
        $sudahDaftar = PendaftaranBeasiswa::where('id_pengguna', Auth::id())
            ->where('id_beasiswa', $beasiswa->id)
            ->exists();

        return view('peserta.beasiswa.show', compact('beasiswa', 'sudahDaftar'));
    }

    public function daftar(Beasiswa $beasiswa)
    {
        // Validasi apakah beasiswa masih bisa didaftar
        if (!$beasiswa->masihAktif()) {
            return back()->with('error', 'Beasiswa sudah tidak tersedia!');
        }

        // Cek apakah user sudah mendaftar
        $sudahDaftar = PendaftaranBeasiswa::where('id_pengguna', Auth::id())
            ->where('id_beasiswa', $beasiswa->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah mendaftar beasiswa ini!');
        }

        return view('peserta.beasiswa.daftar', compact('beasiswa'));
    }

    public function storeDaftar(Request $request, Beasiswa $beasiswa)
    {
        $request->validate([
            'alasan_mendaftar' => 'required|string|min:50',
            'berkas_transkrip' => 'required|file|mimes:pdf|max:2048',
            'berkas_cv' => 'required|file|mimes:pdf|max:2048',
            'berkas_surat_rekomendasi' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        // Validasi ulang
        if (!$beasiswa->masihAktif()) {
            return back()->with('error', 'Beasiswa sudah tidak tersedia!');
        }

        $sudahDaftar = PendaftaranBeasiswa::where('id_pengguna', Auth::id())
            ->where('id_beasiswa', $beasiswa->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah mendaftar beasiswa ini!');
        }

        // Upload berkas
        $berkasTranskrip = $request->file('berkas_transkrip')
            ->store('berkas/transkrip', 'public');
        $berkasCV = $request->file('berkas_cv')
            ->store('berkas/cv', 'public');
        
        $berkasSuratRekomendasi = null;
        if ($request->hasFile('berkas_surat_rekomendasi')) {
            $berkasSuratRekomendasi = $request->file('berkas_surat_rekomendasi')
                ->store('berkas/surat-rekomendasi', 'public');
        }

        // Simpan pendaftaran
        PendaftaranBeasiswa::create([
            'id_pengguna' => Auth::id(),
            'id_beasiswa' => $beasiswa->id,
            'alasan_mendaftar' => $request->alasan_mendaftar,
            'berkas_transkrip' => $berkasTranskrip,
            'berkas_cv' => $berkasCV,
            'berkas_surat_rekomendasi' => $berkasSuratRekomendasi,
            'tanggal_daftar' => now()
        ]);

        return redirect()->route('peserta.pendaftaran.index')
            ->with('sukses', 'Pendaftaran beasiswa berhasil dikirim!');
    }
}