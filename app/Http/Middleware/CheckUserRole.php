<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login
        if (!auth()->check()) {
            // Jika belum, maka redirect ke halaman login
            return redirect('/login');
        }

        // Memeriksa peran pengguna
        if (auth()->user()->role !== 1) {
            // Jika peran pengguna tidak sesuai, maka berikan respon Forbidden
            abort(403, 'Unauthorized access.');
        }

        // Jika peran pengguna sesuai, lanjutkan ke rute yang diminta
        return $next($request);
    }
}
