<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HewanController extends Controller
{
    public function index()
    {
        $hewans = Hewan::latest()->get();
        return view('admin.hewan.index', compact('hewans'));
    }

    public function create()
    {
        return view('admin.hewan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'jenis'      => 'required',
            'umur'       => 'required|integer',
            'deskripsi'  => 'required',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png',
            'kondisi'    => 'required|in:Baik,Sakit',
            'status'     => 'required|in:tersedia,diadopsi',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('photos'), $namaFile);
            $data['foto'] = $namaFile;
        }

        Hewan::create($data);

        return redirect()->route('admin.hewan.index');
    }

    public function edit(Hewan $hewan)
    {
        return view('admin.hewan.edit', compact('hewan'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'jenis'      => 'required',
            'umur'       => 'required|integer',
            'deskripsi'  => 'required',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png',
            'kondisi'    => 'required|in:Baik,Sakit',
            'status'     => 'required|in:tersedia,diadopsi',
        ]);

        if ($request->hasFile('foto')) {
            if ($hewan->foto && File::exists(public_path('photos/'.$hewan->foto))) {
                File::delete(public_path('photos/'.$hewan->foto));
            }

            $file = $request->file('foto');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('photos'), $namaFile);
            $data['foto'] = $namaFile;
        }

        $hewan->update($data);

        return redirect()->route('admin.hewan.index');
    }

    public function destroy($id)
    {
        Hewan::findOrFail($id)->delete();

        return redirect()->route('admin.hewan.index')
            ->with('success', 'Data hewan berhasil dihapus');
    }
}
