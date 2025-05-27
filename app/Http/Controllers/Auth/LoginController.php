<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6' // Perbaiki sintaksis dan nama field
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if ($pengguna && Hash::check($request->password, $pengguna->kata_sandi)) { // Gunakan $request->password
            Auth::login($pengguna);

            if ($pengguna->adalahAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('peserta.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}