@extends('admin.layouts.app')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
    }

    .category-card {
        border-radius: 25px;
        transition: all .3s ease;
        background: #fff;
        border: 2px solid #f3e9e2;
        overflow: hidden;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(139, 115, 85, 0.1);
        border-color: #dbc1ac;
    }

    .category-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fdf8f5;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* SEARCH BOX CUSTOM */
    .search-box .form-control {
        border-radius: 20px 0 0 20px;
        border: 2px solid #f3e9e2;
        padding-left: 20px;
        background: #fff;
    }

    .search-box .form-control:focus {
        border-color: #dbc1ac;
        box-shadow: none;
    }

    .search-box .btn-search {
        border-radius: 0 20px 20px 0;
        background-color: #967e76;
        color: white;
        border: 2px solid #967e76;
        font-weight: 600;
        transition: 0.3s;
    }

    .search-box .btn-search:hover {
        background-color: #634832;
        border-color: #634832;
    }

    /* BUTTONS */
    .btn-add {
        background-color: #967e76;
        color: white;
        border-radius: 20px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-add:hover {
        background-color: #634832;
        color: white;
        transform: scale(1.05);
    }

    .btn-edit-custom {
        background-color: #ece0d1;
        color: #634832;
        font-weight: 600;
        border: none;
    }

    .btn-edit-custom:hover {
        background-color: #dbc1ac;
        color: #634832;
    }

    .btn-delete-custom {
        background-color: #f8d7da;
        color: #842029;
        font-weight: 600;
        border: none;
    }

    .btn-delete-custom:hover {
        background-color: #f1b0b7;
        color: #842029;
    }

    .section-title {
        color: #634832;
        font-weight: 800;
        position: relative;
        padding-bottom: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 4px;
        background: #dbc1ac;
        border-radius: 10px;
    }
</style>

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div class="mb-3 mb-md-0">
            <h4 class="section-title">Kategori Hewan</h4>
            <p class="text-muted small mb-0">Kelola kelompok hewan peliharaan anda</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-add px-4 shadow-sm">
            Tambah Kategori Baru
        </a>
    </div>

    {{-- SEARCH --}}
    <div class="row mb-5 justify-content-center">
        <div class="col-md-6">
            <form method="GET" class="search-box">
                <div class="input-group shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari nama kategori..."
                           value="{{ request('search') }}">
                    <button class="btn btn-search px-4">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID --}}
    <div class="row g-4">

        @forelse($categories as $cat)
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card category-card text-center p-4 h-100 shadow-sm">

                {{-- IMAGE --}}
                <div class="mb-3">
                    @if($cat->image)
                        <img src="{{ asset('storage/'.$cat->image) }}" class="category-img mx-auto">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $cat->nama }}&background=f3e8d3&color=6b4f1d&size=256"
                             class="category-img mx-auto">
                    @endif
                </div>

                {{-- NAME --}}
                <h6 class="fw-bold mb-4" style="color: #634832;">{{ $cat->nama }}</h6>

                {{-- ACTION --}}
                <div class="d-flex justify-content-center gap-2 mt-auto">
                    <a href="{{ route('admin.categories.edit', $cat) }}"
                       class="btn btn-sm btn-edit-custom rounded-pill px-3">
                        Ubah
                    </a>

                    <form action="{{ route('admin.categories.destroy', $cat) }}"
                          method="POST"
                          onsubmit="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-delete-custom rounded-pill px-3">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <h5 class="fw-bold">Data tidak ditemukan</h5>
                <p>Tidak ada kategori yang sesuai dengan kata kunci pencarian anda.</p>
            </div>
        </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $categories->withQueryString()->links() }}
    </div>

</div>
@endsection