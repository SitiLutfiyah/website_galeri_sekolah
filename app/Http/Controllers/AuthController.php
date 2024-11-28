<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Method untuk menampilkan form login 
    public function showFormLogin()
    {
        return view('auth.login');
    }

    // Method untuk menangani proses login 
    public function login(Request $request)
    {
        // Validasi Request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Lakukan Proses Login
        if (auth()->attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // Jika gagal, kembali ke Halaman Login
        return back()->with('error', 'Email atau Password Salah!');
    }

    // Method untuk logout
    public function logout(Request $request)
    {
        // Logout the user
        auth()->logout();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page or homepage
        return redirect('/login');
    }
}
