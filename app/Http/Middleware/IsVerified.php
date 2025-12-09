<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !auth()->user()->isVerified() && !auth()->user()->isAdmin()) {
            return redirect()->route('verification.pending')
                ->with('warning', 'Akun Anda sedang menunggu verifikasi admin.');
        }

        return $next($request);
    }
}
