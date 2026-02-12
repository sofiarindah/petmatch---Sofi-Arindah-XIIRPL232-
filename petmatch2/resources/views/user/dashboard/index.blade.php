@extends('user.layouts.side')

@section('content')
<style>
    :root { --brown:#634832; --tan:#967e76; --cream:#fffaf7; --line:#f3e9e2; --text:#8a6d5d; }
    .hero { background: var(--cream); border:1px solid var(--line); border-radius:24px; padding:32px; margin-bottom:28px; display:flex; align-items:center; gap:24px; }
    .hero h1 { font-size:32px; color:var(--brown); font-weight:800; margin:0; }
    .hero h1 span { color:var(--tan); }
    .hero p { color:var(--text); margin:10px 0 18px; }
    .btn-pet { background:var(--tan); color:#fff; border:none; border-radius:12px; padding:12px 22px; font-weight:700; }
    .btn-pet:hover { background:var(--brown); }
    .features { display:flex; gap:12px; margin:12px 0 4px; flex-wrap:wrap; }
    .feature-card { flex:1; min-width:180px; background:#fff; border:1px solid var(--line); border-radius:16px; padding:14px; text-align:center; color:var(--brown); font-weight:700; }
    .section-title { color:var(--brown); font-weight:800; font-size:20px; margin:10px 0 12px; text-align:center; }
    .search-box input { border:1px solid var(--line); border-radius:8px 0 0 8px !important; }
    .category-card { background:#fff; border:1px solid var(--line); border-radius:16px; padding:16px; text-align:center; color:var(--brown); font-weight:700; }
    .category-img { width:56px; height:56px; object-fit:contain; margin-bottom:10px; }
    .pet-card { border:1px solid var(--line); border-radius:16px; overflow:hidden; }
    .pet-card img { height:200px; width:100%; object-fit:cover; }
    .gender-badge { position:absolute; top:10px; right:10px; background:#fff; border:1px solid var(--line); border-radius:8px; padding:4px 8px; font-size:10px; color:var(--tan); }
</style>

<div class="container">

    <div class="hero">
        <div style="flex:1">
            <h1>Temukan Sahabat <span>Baru Anda</span></h1>
            <p>Hewan penyayang menunggu rumah selamanya. Ajak mereka pulang hari ini.</p>
            <div class="features">
                <a href="#recommended" class="feature-card">Adopt A Pet</a>
                <a href="{{ route('user.hewan') }}" class="feature-card">Be A Volunteer</a>
                <a href="{{ route('user-pembayaran.index') }}" class="feature-card">Donate For Them</a>
            </div>
        </div>
        <div style="flex:0 0 200px; text-align:center">
            <img src="{{ asset('photos/kumpulan.jpeg') }}" alt="Buddy" style="width:200px; height:200px; object-fit:cover; border-radius:50%; border:6px solid #fff; box-shadow:0 4px 12px rgba(0,0,0,0.06)">
        </div>
    </div>

    <div class="section-title">Kategori Hewan</div>
    <div class="row g-3 mb-4 justify-content-center">
        @foreach($categories as $cat)
        <div class="col-md-2 col-6">
            <a href="{{ route('user.index', ['kategori' => $cat->nama]) }}" class="text-decoration-none">
                <div class="category-card {{ request('kategori') == $cat->nama ? 'active-cat' : '' }}">
                    <img src="{{ $cat->image ? asset('storage/' . $cat->image) : asset('photos/icon_kucing.jpeg') }}" class="category-img" alt="{{ $cat->nama }}">
                    <div>{{ $cat->nama }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <h6 id="recommended" class="section-title" style="margin-top:0">Rekomendasi Adopsi</h6>

    {{-- SEARCH --}}
    <form action="{{ route('user.index') }}" method="GET" class="search-box mb-5">
        <div class="input-group" style="max-width: 600px; margin: auto;">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau jenis..." value="{{ request('search') }}">
            <button class="btn btn-pet" type="submit" style="border-radius: 0 15px 15px 0;">
                Cari Data
            </button>
        </div>
    </form>

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
            <div class="text-muted">Maaf, data hewan belum tersedia saat ini.</div>
        </div>
        @endforelse
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('user.hewan') }}" class="btn btn-pet">Lihat Semua</a>
    </div>
</div>
@endsection
