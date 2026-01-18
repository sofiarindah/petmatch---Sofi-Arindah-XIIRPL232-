<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $categories = Category::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(8); // ⬅ WAJIB paginate

    return view('admin.categories.index', compact('categories'));
}


    public function create()
    {
        return view('admin.categories.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|max:50',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'nama'  => $request->nama,
            'image' => $image
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan 🐾');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama'  => 'required|max:50',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('categories', 'public');
        }

        $category->nama = $request->nama;
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate ✨');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        return back()->with('success', 'Kategori dihapus 😿');
    }
}
