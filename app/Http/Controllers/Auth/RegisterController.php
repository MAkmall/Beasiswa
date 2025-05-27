<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'kata_sandi' => 'required|string|min:8|confirmed',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tingkat_pendidikan' => 'required|string',
            'universitas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4'
        ]);

        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => 'peserta',
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'universitas' => $request->universitas,
            'jurusan' => $request->jurusan,
            'ipk' => $request->ipk
        ]);

        Auth::login($pengguna);

        return redirect()->route('peserta.dashboard')
            ->with('sukses', 'Registrasi berhasil! Selamat datang di sistem beasiswa.');
    }
}
