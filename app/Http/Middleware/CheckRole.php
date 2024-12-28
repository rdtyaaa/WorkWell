<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Memeriksa apakah pengguna sudah login dan memiliki role yang sesuai
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request); // Jika cocok, lanjutkan request
        }

        // Jika tidak cocok, bisa redirect ke halaman yang sesuai atau memberikan error
        return redirect('/dashboard')->with('error', 'Access denied: You do not have the required role.');
    }
}
