@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="card-title fw-semibold mb-4">Ubah Data Hewan</h5>

        <form action="{{ route('admin.hewan.update', $hewan->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <input type="text"
                       name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $hewan->nama) }}">
                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" 
                            {{ old('category_id', $hewan->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Jenis --}}
            <div class="mb-3">
                <label class="form-label">Jenis / Ras</label>
                <input type="text"
                       name="jenis"
                       class="form-control @error('jenis') is-invalid @enderror"
                       value="{{ old('jenis', $hewan->jenis) }}">
                @error('jenis') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Umur --}}
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="text"
                       name="umur"
                       class="form-control @error('umur') is-invalid @enderror"
                       value="{{ old('umur', $hewan->umur) }}">
                @error('umur') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender"
                        class="form-select @error('gender') is-invalid @enderror">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="jantan" {{ old('gender') == 'jantan' ? 'selected' : '' }}>
                        Jantan
                    </option>
                    <option value="betina" {{ old('gender') == 'betina' ? 'selected' : '' }}>
                        Betina
                    </option>
                </select>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          rows="3">{{ old('deskripsi', $hewan->deskripsi) }}</textarea>
                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto</label>
                @if ($hewan->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$hewan->foto) }}"
                             width="100"
                             class="rounded">
                    </div>
                @endif
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
                    <option value="Baik" {{ $hewan->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Sakit" {{ $hewan->kondisi == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
                @error('kondisi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status"
                        class="form-select @error('status') is-invalid @enderror">
                    <option value="tersedia" {{ $hewan->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="diadopsi" {{ $hewan->status == 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
                </select>
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Tombol --}}
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.hewan.index') }}" class="btn btn-warning">Kembali</a>

        </form>

    </div>
</div>
@endsection
