<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['username' => 'Akun Anda tidak aktif. Silakan hubungi Admin IT.']);
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect user based on their specific role to their correct home page
        if ($user->role === 'admin_kasir') {
            return redirect()->route('pos.index');
        } elseif ($user->role === 'keuangan') {
            return redirect()->route('keuangan.dashboard');
        } elseif ($user->role === 'admin_it') {
            return redirect()->route('it.dashboard');
        }

        Auth::logout();
        return redirect()->route('login')->withErrors(['username' => 'Peran pengguna tidak valid.']);
    }
}
