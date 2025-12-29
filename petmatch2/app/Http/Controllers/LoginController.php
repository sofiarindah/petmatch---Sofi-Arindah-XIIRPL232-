<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔑 BEDAKAN ROLE
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // default = user
            return redirect()->route('user.dashboard');
        }

        // gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
