@extends('user.layouts.side')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
        color: #5d4037;
    }
    .container { max-width: 1200px; }

    /* ===== HERO SECTION ===== */
    .hero {
        margin: 20px 0 80px;
        padding: 80px 60px;
        border-radius: 50px;
        background: #fffaf7;
        border: 2px solid #f3e9e2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: #fcf1e8;
        border-radius: 50%;
        z-index: 0;
    }
    .hero div { position: relative; z-index: 1; }
    .hero h1 {
        font-size: 48px;
        font-weight: 800;
        color: #634832;
        line-height: 1.2;
    }
    .hero h1 span { color: #967e76; }
    .hero p {
        margin: 20px 0 35px;
        color: #8a6d5d;
        font-size: 18px;
    }
    .hero img {
        width: 380px;
        height: 380px;
        object-fit: cover;
        border-radius: 50%;
        padding: 15px;
        background: white;
        border: 8px solid #fdf8f5;
        box-shadow: 0 20px 40px rgba(139, 115, 85, 0.1);
        position: relative;
        z-index: 1;
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

    /* ===== CATEGORY CARDS ===== */
    .category-card {
        background: white;
        border-radius: 25px;
        padding: 25px 15px;
        text-align: center;
        transition: 0.3s;
        border: 2px solid #f3e9e2;
        height: 100%;
    }
    .category-card:hover {
        transform: translateY(-8px);
        border-color: #dbc1ac;
        box-shadow: 0 15px 30px rgba(139, 115, 85, 0.1);
    }
    .category-img {
        width: 65px;
        height: 65px;
        object-fit: contain;
        margin-bottom: 15px;
        filter: sepia(0.2);
    }
    .category-card strong {
        display: block;
        color: #634832;
        font-size: 15px;
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

    /* ===== TUTORIAL SECTION ===== */
    .tutorial-box {
        background: white;
        border-radius: 40px;
        padding: 60px;
        border: 2px solid #f3e9e2;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }
    .img-bundar {
        width: 280px;
        height: 280px;
        object-fit: cover;
        border-radius: 50%;
        border: 10px solid #fdf8f5;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .step {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        align-items: flex-start;
    }
    .step span {
        min-width: 40px;
        height: 40px;
        background: #f3e9e2;
        color: #967e76;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
    }
    .step p { margin: 0; color: #7d5a50; font-weight: 500; line-height: 1.6; }

    /* ===== FOOTER ===== */
    .footer {
        background: #ffffff;
        border-top: 2px solid #f3e9e2;
        padding: 80px 0 40px;
        margin-top: 100px;
    }
    .footer h6 { font-weight: 800; color: #634832; margin-bottom: 20px; }
    .footer p { color: #a68b7c; font-size: 14px; }
</style>

<div class="container">

    {{-- ===== HERO ===== --}}
    <div class="hero">
        <div>
            <h1>Temukan Sahabat <span>Baru Anda</span></h1>
            <p>Berikan rumah yang hangat untuk hewan peliharaan yang membutuhkan kasih sayang.</p>
            <a href="#recommended" class="btn btn-pet">
                MULAI ADOPSI
            </a>
        </div>
        <img src="{{ asset('photos/kumpulan.jpeg') }}" alt="Hero Image">
    </div>

    {{-- ===== CATEGORY ===== --}}
    <h4 class="section-title">Kategori Hewan</h4>
    <p class="section-sub">Pilih teman imut sesuai keinginan anda</p>

    @php
    $categories = [
        ['name' => 'Anjing', 'image' => asset('photos/icon_anjing.jpeg')],
        ['name' => 'Kucing', 'image' => asset('photos/icon_kucing.jpeg')],
        ['name' => 'Hamster', 'image' => asset('photos/icon_hamster.jpeg')],
        ['name' => 'Kelinci', 'image' => asset('photos/icon_kelinci.jpeg')],
        ['name' => 'Landak', 'image' => asset('photos/icon_landak.jpeg')],
        ['name' => 'Sugar Glider', 'image' => asset('photos/icon_sugar.jpeg')],
        ['name' => 'Lovebird', 'image' => asset('photos/icon_lovebird.jpeg')],
    ];
    @endphp

    <div class="row g-4 mb-5 justify-content-center">
        @foreach($categories as $cat)
        <div class="col-md-2 col-6">
            <div class="category-card">
                <img src="{{ $cat['image'] }}" class="category-img">
                <strong>{{ $cat['name'] }}</strong>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ===== RECOMMENDED ===== --}}
    <h4 id="recommended" class="section-title">Rekomendasi Adopsi</h4>
    <p class="section-sub">Daftar hewan yang sedang menunggu rumah baru</p>

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

    {{-- ===== TUTORIALS ===== --}}
    <div class="py-5 mt-5">
        <div class="tutorial-box">
            <div class="row align-items-center">
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <img src="{{ asset('photos/icon_merawat.jpeg') }}" class="img-bundar">
                </div>
                <div class="col-md-7">
                    <h3 class="fw-bold mb-3" style="color: #634832;">Panduan Merawat Hewan</h3>
                    <p class="text-muted mb-4">Langkah dasar untuk memastikan peliharaan anda tetap sehat dan bahagia.</p>
                    
                    <div class="step">
                        <span>01</span>
                        <p>Berikan nutrisi terbaik sesuai dengan jenis dan kebutuhan usia hewan.</p>
                    </div>
                    <div class="step">
                        <span>02</span>
                        <p>Pastikan ketersediaan air minum yang bersih dan segar setiap waktu.</p>
                    </div>
                    <div class="step">
                        <span>03</span>
                        <p>Menjaga kebersihan tubuh hewan dan area kandang secara terjadwal.</p>
                    </div>
                    <div class="step">
                        <span>04</span>
                        <p>Berikan perhatian dan waktu bermain untuk menjaga kesehatan mentalnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tutorial-box" style="background: #fffaf7;">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <img src="{{ asset('photos/icon_pengenalan.jpeg') }}" class="img-bundar">
                </div>
                <div class="col-md-7">
                    <h3 class="fw-bold mb-3" style="color: #634832;">Adaptasi dengan Lingkungan</h3>
                    <p class="text-muted mb-4">Proses pengenalan yang tepat akan mempercepat proses bonding dengan anda.</p>
                    
                    <div class="step">
                        <span>01</span>
                        <p>Biarkan hewan mengeksplorasi ruangan baru tanpa adanya paksaan.</p>
                    </div>
                    <div class="step">
                        <span>02</span>
                        <p>Hindari kontak fisik yang berlebihan pada hari-hari pertama adaptasi.</p>
                    </div>
                    <div class="step">
                        <span>03</span>
                        <p>Gunakan nada suara yang rendah dan lembut saat berinteraksi.</p>
                    </div>
                    <div class="step">
                        <span>04</span>
                        <p>Gunakan camilan sebagai hadiah atas keberaniannya berinteraksi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== FOOTER ===== --}}
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h6>PetMatch</h6>
                <p>Platform adopsi tepercaya yang menghubungkan pecinta hewan dengan teman baru mereka. Kami berkomitmen untuk memastikan setiap hewan mendapatkan rumah yang layak.</p>
            </div>
            <div class="col-md-3 ms-auto">
                <h6>Informasi Kontak</h6>
                <p>Surel: support@petmatch.com</p>
                <p>Telepon: +62 812 3456 7890</p>
            </div>
        </div>
        <div class="text-center mt-5 pt-4 border-top" style="color: #a68b7c; font-size: 13px;">
            &copy; {{ date('Y') }} PetMatch. Seluruh hak cipta dilindungi undang-undang.
        </div>
    </div>
</footer>
@endsection