<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showRegister() {
        return view('auth.register');
    }

    // 2. Proses Simpan User Baru
    public function register(Request $request) {
        // Validasi input agar aman
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // confirmed artinya butuh field password_confirmation
        ]);

        // Buat User Baru (Default role: user)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default jadi penyewa
        ]);

        // Langsung login otomatis setelah daftar
        Auth::login($user);

        // Arahkan ke halaman utama
        return redirect('/')->with('success', 'Selamat bergabung! Akun berhasil dibuat.');
    }
    // Tampilkan Form Login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login otomatis
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role dan arahkan sesuai hak akses
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }

            return redirect()->intended('/');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Maaf, email atau password salah.',
        ]);
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
