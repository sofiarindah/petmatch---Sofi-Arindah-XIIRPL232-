@extends('user.layouts.side')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
        color: #5d4037;
    }
    .container { max-width: 1200px; }

    /* ===== SECTION TITLES ===== */
    .section-title {
        font-weight: 800;
        text-align: center;
        font-size: 32px;
        color: #634832;
        margin-top: 20px;
    }
    .section-sub {
        text-align: center;
        color: #a68b7c;
        margin-bottom: 50px;
        font-weight: 500;
    }

    /* ===== BUTTON STYLE ===== */
    .btn-pet {
        background: #967e76;
        color: #fff !important;
        border-radius: 15px;
        padding: 14px 40px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 8px 20px rgba(150, 126, 118, 0.2);
    }
    .btn-pet:hover {
        background: #634832;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(99, 72, 50, 0.3);
    }

    /* ===== CATEGORY CARDS ===== */
    .category-card {
        background: white;
        border-radius: 25px;
        padding: 15px;
        text-align: center;
        transition: 0.3s;
        border: 2px solid #f3e9e2;
        height: 100%;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .category-card:hover, .active-cat {
        transform: translateY(-5px);
        border-color: #967e76 !important;
        background: #fffaf7 !important;
        box-shadow: 0 10px 20px rgba(139, 115, 85, 0.1);
    }
    .category-img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        margin-bottom: 10px;
        filter: sepia(0.2);
    }
    .category-card strong {
        display: block;
        color: #634832;
        font-size: 13px;
    }

    /* ===== PET CARDS ===== */
    .pet-card {
        border-radius: 30px;
        overflow: hidden;
        background: white;
        border: 2px solid #f3e9e2;
        transition: 0.3s;
        height: 100%;
    }
    .pet-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(139, 115, 85, 0.12);
    }
    .pet-card img {
        height: 240px;
        width: 100%;
        object-fit: cover;
    }
    .gender-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        padding: 6px 15px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 800;
        color: #967e76;
        text-transform: uppercase;
        border: 1px solid #f3e9e2;
    }

    /* ===== SEARCH BOX ===== */
    .search-box input {
        border-radius: 15px 0 0 15px !important;
        border: 2px solid #f3e9e2;
        padding: 12px 20px;
        background: white;
    }
    .search-box input:focus {
        border-color: #dbc1ac;
        box-shadow: none;
    }
</style>

<div class="container py-4">

    <h4 class="section-title">Temukan Teman Baru</h4>
    <p class="section-sub">Jelajahi semua hewan yang sedang mencari rumah hangat</p>

    {{-- SEARCH --}}
    <form action="{{ route('user.hewan') }}" method="GET" class="search-box mb-5">
        <div class="input-group" style="max-width: 600px; margin: auto;">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau jenis..." value="{{ request('search') }}">
            <button class="btn btn-pet" type="submit" style="border-radius: 0 15px 15px 0;">
                Cari Data
            </button>
        </div>
    </form>

    {{-- CATEGORY FILTER --}}
    <div class="row g-3 mb-5 justify-content-center">
        <div class="col-md-2 col-4">
            <a href="{{ route('user.hewan') }}" class="text-decoration-none">
                <div class="category-card {{ !request('kategori') ? 'active-cat' : '' }}">
                    <strong style="font-size: 16px;">Semua</strong>
                </div>
            </a>
        </div>
        @foreach($categories as $cat)
        <div class="col-md-2 col-4">
            <a href="{{ route('user.hewan', array_merge(request()->query(), ['kategori' => $cat->nama])) }}" class="text-decoration-none">
                <div class="category-card {{ request('kategori') == $cat->nama ? 'active-cat' : '' }}">
                    <img src="{{ $cat->image ? asset('storage/' . $cat->image) : asset('photos/icon_kucing.jpeg') }}" class="category-img">
                    <strong>{{ $cat->nama }}</strong>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- LIST HEWAN --}}
    <div class="row g-4">
        @forelse($hewans as $hewan)
        <div class="col-md-3">
            <div class="card pet-card">
                <span class="gender-badge">{{ $hewan->gender }}</span>
                <img src="{{ $hewan->foto ? asset('photos/'.$hewan->foto) : 'https://placehold.co/600x400' }}">
                <div class="card-body text-center p-4">
                    <h6 class="fw-bold mb-1" style="color: #634832;">{{ $hewan->nama }}</h6>
                    <small class="text-muted d-block mb-3">{{ $hewan->jenis }} • {{ $hewan->umur }}</small>
                    <p class="text-muted mb-4" style="font-size:13px; min-height: 40px;">
                        {{ Str::limit($hewan->deskripsi, 60) }}
                    </p>
                    <a href="{{ route('user.detail', $hewan->id) }}"
                    class="btn btn-pet w-100 py-2">
                        LIHAT DETAIL
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">Maaf, data hewan tidak ditemukan.</div>
            @if(request('search') || request('kategori'))
                <a href="{{ route('user.hewan') }}" class="btn btn-outline-secondary mt-3" style="border-radius: 50px;">Reset Pencarian</a>
            @endif
        </div>
        @endforelse
    </div>

</div>
@endsection
