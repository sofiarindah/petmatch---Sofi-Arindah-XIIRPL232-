@extends('admin.layouts.app')

@section('content')
<style>
    body {
        background: #fdf8f5 !important;
        font-family: 'Poppins', sans-serif;
    }

    .form-card {
        background: #ffffff;
        border-radius: 25px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.05);
        padding: 40px;
        max-width: 600px;
        margin: auto;
    }

    .form-title {
        color: #634832;
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 40px;
        height: 5px;
        background: #dbc1ac;
        border-radius: 10px;
    }

    .form-label {
        color: #7d5a50;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .custom-input {
        background: #fdf8f5 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px !important;
        padding: 12px 20px !important;
        color: #5d4037 !important;
        transition: 0.3s !important;
    }

    .custom-input:focus {
        border-color: #dbc1ac !important;
        box-shadow: 0 0 0 4px rgba(219, 193, 172, 0.1) !important;
        outline: none;
    }

    .image-preview {
        background: #fffaf7;
        padding: 15px;
        border-radius: 20px;
        border: 2px dashed #dbc1ac;
        display: inline-block;
        margin-bottom: 15px;
    }

    .image-preview img {
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .btn-update {
        background: #967e76 !important;
        color: white !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 12px 30px !important;
        font-weight: 700 !important;
        width: 100%;
        transition: 0.3s !important;
        margin-top: 20px;
    }

    .btn-update:hover {
        background: #634832 !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(99, 72, 50, 0.2) !important;
    }

    .btn-back {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #a68b7c;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-back:hover {
        color: #634832;
    }
</style>

<div class="container py-5">
    <div class="form-card">
        <h4 class="form-title">Edit Kategori</h4>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" value="{{ $category->nama }}" 
                       class="form-control custom-input" placeholder="Masukkan nama kategori..." required>
            </div>

            <div class="mb-4">
                <label class="form-label">Gambar Kategori</label>
                <div class="d-block">
                    @if($category->image)
                        <div class="image-preview">
                            <img src="{{ asset('storage/'.$category->image) }}" width="120" height="120">
                            <div class="text-center mt-2">
                                <small class="text-muted" style="font-size: 11px;">Gambar Saat Ini</small>
                            </div>
                        </div>
                    @endif
                </div>
                <input type="file" name="image" class="form-control custom-input">
                <small class="text-muted mt-2 d-block" style="font-size: 12px; padding-left: 5px;">
                    Format: JPG, PNG, atau JPEG (Maks. 2MB)
                </small>
            </div>

            <button type="submit" class="btn btn-update shadow-sm">Simpan Perubahan</button>
            
            <a href="{{ route('admin.categories.index') }}" class="btn-back">
                Kembali ke Daftar Kategori
            </a>
        </form>
    </div>
</div>
@endsection