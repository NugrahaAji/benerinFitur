<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lewati pengecekan jika user adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Cek apakah user sudah diverifikasi
        if (auth()->check() && !auth()->user()->is_verified) {
            return redirect()->route('verification.pending')
                ->with('error', 'Akun Anda masih menunggu verifikasi dari admin.');
        }

        return $next($request);
    }
}
