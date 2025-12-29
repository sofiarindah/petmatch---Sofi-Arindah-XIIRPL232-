@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="card-title fw-semibold mb-4">+ Tambah Data Hewan</h5>

        <form action="{{ route('admin.hewan.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <input type="text"
                       name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}">
                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Jenis --}}
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <input type="text"
                       name="jenis"
                       class="form-control @error('jenis') is-invalid @enderror"
                       value="{{ old('jenis') }}">
                @error('jenis') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Umur --}}
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="number"
                       name="umur"
                       class="form-control @error('umur') is-invalid @enderror"
                       value="{{ old('umur') }}">
                @error('umur') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file"
                       name="foto"
                       class="form-control @error('foto') is-invalid @enderror">
                @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Kondisi --}}
            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi"
                        class="form-select @error('kondisi') is-invalid @enderror">
                    <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Sakit" {{ old('kondisi') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
                @error('kondisi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status"
                        class="form-select @error('status') is-invalid @enderror">
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="diadopsi" {{ old('status') == 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
                </select>
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.hewan.index') }}" class="btn btn-warning">Kembali</a>

        </form>

    </div>
</div>
@endsection
