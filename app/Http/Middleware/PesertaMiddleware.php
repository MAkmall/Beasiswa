<?php

// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah pengguna adalah admin
        if (Auth::user()->role !== 'Peserta') { // Sesuaikan dengan logika peran Anda
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
