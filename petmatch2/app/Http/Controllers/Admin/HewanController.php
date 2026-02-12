<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HewanController extends Controller
{
    public function index()
    {
        $hewans = Hewan::with('category')->latest()->get();
        return view('admin.hewan.index', compact('hewans'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.hewan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required|string|max:255',
            'category_id'=> 'required|exists:categories,id',
            'jenis'      => 'required|string|max:100',
            'umur'       => 'required|string|max:50',
            'gender'     => 'required|in:jantan,betina',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kondisi'    => 'required|in:Baik,Sakit',
            'status'     => 'required|in:tersedia,diadopsi',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos'), $namaFile);
            $data['foto'] = $namaFile;
        }

        Hewan::create($data);

        return redirect()->route('admin.hewan.index')
                         ->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function edit(Hewan $hewan)
    {
        $categories = Category::all();
        return view('admin.hewan.edit', compact('hewan', 'categories'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        $data = $request->validate([
            'nama'       => 'required|string|max:255',
            'category_id'=> 'required|exists:categories,id',
            'jenis'      => 'required|string|max:100',
            'umur'       => 'required|string|max:50',
            'gender'     => 'required|in:jantan,betina',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kondisi'    => 'required|in:Baik,Sakit',
            'status'     => 'required|in:tersedia,diadopsi',
        ]);

        if ($request->hasFile('foto')) {
            if ($hewan->foto && File::exists(public_path('photos/' . $hewan->foto))) {
                File::delete(public_path('photos/' . $hewan->foto));
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos'), $namaFile);
            $data['foto'] = $namaFile;
        }

        $hewan->update($data);

        return redirect()->route('admin.hewan.index')
                         ->with('success', 'Data hewan berhasil diperbarui!');
    }

    public function destroy(Hewan $hewan)
    {
        if ($hewan->foto && File::exists(public_path('photos/' . $hewan->foto))) {
            File::delete(public_path('photos/' . $hewan->foto));
        }

        $hewan->delete();

        return redirect()->route('admin.hewan.index')
                         ->with('success', 'Data hewan berhasil dihapus!');
    }
}
