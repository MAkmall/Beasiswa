<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranBeasiswa::where('id_pengguna', Auth::id())
            ->with('beasiswa');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_pendaftaran', $request->status);
        }

        $pendaftaran = $query->latest()->paginate(10);

        return view('peserta.pendaftaran.index', compact('pendaftaran'));
    }

    public function show(PendaftaranBeasiswa $pendaftaran)
    {
        // Pastikan pendaftaran milik user yang login
        if ($pendaftaran->id_pengguna != Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $pendaftaran->load('beasiswa');
        return view('peserta.pendaftaran.show', compact('pendaftaran'));
    }
}