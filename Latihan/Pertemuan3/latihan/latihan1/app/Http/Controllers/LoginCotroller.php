<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginCotroller extends Controller
{
   public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Logic login dengan Auth::attempt
        if (Auth::attempt($request->only('email', 'password'))) {
            // Login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/posts');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
