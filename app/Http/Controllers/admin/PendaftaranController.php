<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranBeasiswa;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranBeasiswa::with(['pengguna', 'beasiswa']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_pendaftaran', $request->status);
        }

        // Filter berdasarkan beasiswa
        if ($request->has('beasiswa') && $request->beasiswa != '') {
            $query->where('id_beasiswa', $request->beasiswa);
        }

        $pendaftaran = $query->latest()->paginate(15);
        $beasiswaList = Beasiswa::aktif()->get();

        return view('admin.pendaftaran.index', compact('pendaftaran', 'beasiswaList'));
    }

    public function show(PendaftaranBeasiswa $pendaftaran)
    {
        $pendaftaran->load(['pengguna', 'beasiswa']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function terima(Request $request, PendaftaranBeasiswa $pendaftaran)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string'
        ]);

        // Cek apakah masih ada kuota
        if ($pendaftaran->beasiswa->kuota_tersedia <= 0) {
            return back()->with('error', 'Kuota beasiswa sudah habis!');
        }

        $pendaftaran->update([
            'status_pendaftaran' => 'diterima',
            'catatan_admin' => $request->catatan_admin,
            'tanggal_keputusan' => now()
        ]);

        // Kurangi kuota tersedia
        $pendaftaran->beasiswa->decrement('kuota_tersedia');

        return back()->with('sukses', 'Pendaftaran berhasil diterima!');
    }

    public function tolak(Request $request, PendaftaranBeasiswa $pendaftaran)
    {
        $request->validate([
            'catatan_admin' => 'required|string'
        ]);

        $pendaftaran->update([
            'status_pendaftaran' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
            'tanggal_keputusan' => now()
        ]);

        return back()->with('sukses', 'Pendaftaran berhasil ditolak!');
    }
}