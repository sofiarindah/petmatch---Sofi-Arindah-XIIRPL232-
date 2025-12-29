<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    // Menampilkan profil (pakai Auth jika ada, kalau tidak fallback ke admin pertama)
    public function index()
    {
        $admin = $this->getAdminModel();
        return view('admin.profile.index', compact('admin'));
    }

    // Form edit profil
    public function edit()
    {
        $admin = $this->getAdminModel();
        return view('admin.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $user = auth()->user();

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        // Ganti foto jika ada
        if ($request->hasFile('foto')) {

            if ($user->foto && File::exists(public_path('storage/'.$user->foto))) {
                File::delete(public_path('storage/'.$user->foto));
            }

            $validated['foto'] = $request->file('foto')->store('foto-admin');
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Helper untuk mendapatkan model admin: pakai Auth jika tersedia, else fallback ke Admin::first()
    protected function getAdminModel()
    {
        // prioritas: jika ada user login dan instance of Admin model, gunakan itu
        $user = Auth::user();
        if ($user instanceof Admin) {
            return $user;
        }

        // jika Auth::user() exists and has same email in admins table, prefer that record
        if ($user) {
            $admin = Admin::where('email', $user->email)->first();
            if ($admin) return $admin;
        }

        // fallback: ambil admin pertama
        return Admin::first();
    }
}
