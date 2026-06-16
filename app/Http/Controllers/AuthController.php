<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = $credentials['username'];
        $password = $credentials['password'];

        // Cari user berdasarkan username ATAU email
        $user = User::where('username', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withErrors([
                'username' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ])->withInput($request->only('username'));
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'username' => 'Akun Anda dinonaktifkan. Silakan hubungi Admin IT.',
            ])->withInput($request->only('username'));
        }

        // Jalankan login
        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();

        return $this->redirectBasedOnRole($user);
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Helper untuk redirect berdasarkan role pengguna.
     */
    private function redirectBasedOnRole(User $user)
    {
        switch ($user->role) {
            case 'admin_kasir':
                return redirect()->route('pos.index');
            case 'keuangan':
                return redirect()->route('keuangan.dashboard');
            case 'admin_it':
                return redirect()->route('it.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['username' => 'Peran tidak dikenali.']);
        }
    }
}
