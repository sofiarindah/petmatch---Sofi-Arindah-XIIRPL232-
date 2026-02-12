@extends('admin.layouts.app')

@section('content')
<style>
    body {
        background: #fdf8f5 !important;
        font-family: 'Poppins', sans-serif;
    }

    .form-card {
        background: #ffffff;
        border-radius: 30px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 12px 35px rgba(139, 115, 85, 0.07);
        padding: 40px;
        margin-bottom: 40px;
    }

    .page-title {
        color: #634832;
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title::before {
        content: '';
        width: 8px;
        height: 35px;
        background: #dbc1ac;
        border-radius: 10px;
        display: inline-block;
    }

    .form-label {
        color: #7d5a50;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .custom-input, .custom-select, .custom-textarea {
        background: #fdf8f5 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px !important;
        padding: 12px 18px !important;
        color: #5d4037 !important;
        transition: 0.3s !important;
    }

    .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
        border-color: #dbc1ac !important;
        box-shadow: 0 0 0 4px rgba(219, 193, 172, 0.15) !important;
        background: #ffffff !important;
    }

    .btn-save {
        background: #967e76 !important;
        color: white !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 12px 35px !important;
        font-weight: 700 !important;
        transition: 0.3s !important;
    }

    .btn-save:hover {
        background: #634832 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99, 72, 50, 0.2) !important;
    }

    .btn-cancel {
        background: #ece0d1 !important;
        color: #7d5a50 !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 12px 35px !important;
        font-weight: 700 !important;
        transition: 0.3s !important;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #dbc1ac !important;
        color: #634832 !important;
    }

    .text-danger {
        font-weight: 600;
        font-size: 0.8rem;
        margin-top: 5px;
        display: block;
        padding-left: 5px;
    }
</style>

<div class="container py-4">
    <div class="form-card">
        <h4 class="page-title">Tambah Data Hewan</h4>

        <form action="{{ route('admin.hewan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nama Hewan</label>
                        <input type="text" name="nama" class="form-control custom-input @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" placeholder="Contoh: Luna">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select custom-select @error('category_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Jenis / Ras</label>
                        <input type="text" name="jenis" class="form-control custom-input @error('jenis') is-invalid @enderror" 
                               value="{{ old('jenis') }}" placeholder="Contoh: Persia, Golden Retriever">
                        @error('jenis') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label">Umur</label>
                                <input type="text" name="umur" class="form-control custom-input @error('umur') is-invalid @enderror" 
                                       value="{{ old('umur') }}" placeholder="2 Tahun">
                                @error('umur') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="gender" class="form-select custom-select @error('gender') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="jantan" {{ old('gender') == 'jantan' ? 'selected' : '' }}>Jantan</option>
                                    <option value="betina" {{ old('gender') == 'betina' ? 'selected' : '' }}>Betina</option>
                                </select>
                                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Kondisi Kesehatan</label>
                        <select name="kondisi" class="form-select custom-select @error('kondisi') is-invalid @enderror">
                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="Sakit" {{ old('kondisi') == 'Sakit' ? 'selected' : '' }}>Dalam Perawatan</option>
                        </select>
                        @error('kondisi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status Adopsi</label>
                        <select name="status" class="form-select custom-select @error('status') is-invalid @enderror">
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="diadopsi" {{ old('status') == 'diadopsi' ? 'selected' : '' }}>Sudah Diadopsi</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Unggah Foto</label>
                        <input type="file" name="foto" class="form-control custom-input @error('foto') is-invalid @enderror">
                        @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Baris Bawah --}}
                <div class="col-12">
                    <div class="mb-4">
                        <label class="form-label">Deskripsi & Kepribadian</label>
                        <textarea name="deskripsi" class="form-control custom-textarea @error('deskripsi') is-invalid @enderror" 
                                  rows="4" placeholder="Ceritakan sedikit tentang karakter hewan ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-save shadow-sm">Simpan Data</button>
                <a href="{{ route('admin.hewan.index') }}" class="btn btn-cancel">Batal</a>
            </div>

        </form>
    </div>
</div>
@endsection