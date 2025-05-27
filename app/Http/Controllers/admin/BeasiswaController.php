<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswa = Beasiswa::latest()->paginate(10);
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah_dana' => 'required|numeric|min:0',
            'kuota_total' => 'required|integer|min:1',
            'persyaratan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tingkat_pendidikan_target' => 'required|string',
            'minimal_ipk' => 'required|numeric|min:0|max:4'
        ]);

        $data = $request->all();
        $data['kuota_tersedia'] = $request->kuota_total;

        Beasiswa::create($data);

        return redirect()->route('admin.beasiswa.index')
            ->with('sukses', 'Beasiswa berhasil ditambahkan!');
    }

    public function show(Beasiswa $beasiswa)
    {
        $pendaftaran = $beasiswa->pendaftaranBeasiswa()
            ->with('pengguna')->latest()->paginate(10);
        
        return view('admin.beasiswa.show', compact('beasiswa', 'pendaftaran'));
    }

    public function edit(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, Beasiswa $beasiswa)
    {
        $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah_dana' => 'required|numeric|min:0',
            'kuota_total' => 'required|integer|min:1',
            'persyaratan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tingkat_pendidikan_target' => 'required|string',
            'minimal_ipk' => 'required|numeric|min:0|max:4',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Hitung ulang kuota tersedia jika kuota total berubah
        $selisihKuota = $request->kuota_total - $beasiswa->kuota_total;
        $kuotaTersediaBaru = $beasiswa->kuota_tersedia + $selisihKuota;

        $data = $request->all();
        $data['kuota_tersedia'] = max(0, $kuotaTersediaBaru);

        $beasiswa->update($data);

        return redirect()->route('admin.beasiswa.index')
            ->with('sukses', 'Beasiswa berhasil diperbarui!');
    }

    public function destroy(Beasiswa $beasiswa)
    {
        // Cek apakah ada pendaftaran untuk beasiswa ini
        if ($beasiswa->pendaftaranBeasiswa()->count() > 0) {
            return redirect()->route('admin.beasiswa.index')
                ->with('error', 'Tidak dapat menghapus beasiswa yang sudah memiliki pendaftar!');
        }

        $beasiswa->delete();

        return redirect()->route('admin.beasiswa.index')
            ->with('sukses', 'Beasiswa berhasil dihapus!');
    }
}