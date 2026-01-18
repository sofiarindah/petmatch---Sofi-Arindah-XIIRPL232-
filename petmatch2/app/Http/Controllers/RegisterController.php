<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

    User::create([
    'nama'     => $request->name, // ⬅️ HARUS ADA
    'name'     => $request->name,
    'username' => $request->username,
    'email'    => $request->email,
    'password' => Hash::make($request->password),
    'role'     => 'user',
]);



        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
