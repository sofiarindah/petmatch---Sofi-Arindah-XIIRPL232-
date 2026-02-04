@extends('user.layouts.side')

@section('content')
<style>
    .detail-container {
        max-width: 1000px;
        margin: 20px auto;
    }

    .detail-card {
        background: white;
        border-radius: 40px;
        border: 2px solid #f3e9e2;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(139, 115, 85, 0.05);
        display: flex;
        flex-wrap: wrap;
    }

    /* Bagian Kiri: Foto */
    .detail-image-section {
        flex: 1;
        min-width: 400px;
        padding: 30px;
        background: #fffaf7;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-image-section img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 30px;
        border: 8px solid white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }

    /* Bagian Kanan: Info */
    .detail-info-section {
        flex: 1.2;
        min-width: 400px;
        padding: 50px;
    }

    .pet-name {
        font-weight: 800;
        font-size: 36px;
        color: #634832;
        margin-bottom: 5px;
    }

    .pet-badge {
        display: inline-block;
        padding: 6px 15px;
        background: #f3e9e2;
        color: #967e76;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    .info-group {
        margin-bottom: 20px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #a68b7c;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 18px;
        color: #5d4037;
        font-weight: 500;
    }

    .pet-description {
        background: #fdf8f5;
        padding: 20px;
        border-radius: 20px;
        color: #7d5a50;
        line-height: 1.6;
        margin-top: 20px;
        border-left: 5px solid #dbc1ac;
    }

    .btn-adopt {
        background: #967e76;
        color: white !important;
        border: none;
        border-radius: 18px;
        padding: 15px 35px;
        font-weight: 800;
        width: 100%;
        margin-top: 30px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-adopt:hover {
        background: #634832;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 72, 50, 0.2);
    }

    .btn-back {
        color: #a68b7c;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: #634832;
    }

    @media (max-width: 768px) {
        .detail-card { flex-direction: column; }
        .detail-image-section { min-width: 100%; }
        .detail-info-section { padding: 30px; }
    }

    .btn-permintaan {
    background: transparent;
    color: #967e76;
    border: 2px dashed #dbc1ac;
    border-radius: 18px;
    padding: 14px 35px;
    font-weight: 800;
    width: 100%;
    margin-top: 12px;
    transition: 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-permintaan:hover {
    background: #f3e9e2;
    color: #634832;
}

</style>

<div class="container detail-container">
    {{-- Tombol Kembali --}}
    <a href="{{ route('user.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    @if($detail)
        <div class="detail-card">
            {{-- Sisi Kiri: Foto Hewan --}}
            <div class="detail-image-section">
                <img src="{{ $detail->foto ? asset('photos/'.$detail->foto) : 'https://placehold.co/600x600' }}" 
                     alt="{{ $detail->nama }}">
            </div>

            {{-- Sisi Kanan: Detail Info --}}
            <div class="detail-info-section">
                <span class="pet-badge">{{ $detail->jenis ?? 'Lainnya' }}</span>
                <h2 class="pet-name">{{ $detail->nama ?? 'Teman Kecil' }}</h2>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="info-group">
                            <span class="info-label">Umur</span>
                            <span class="info-value">{{ $detail->umur ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-group">
                            <span class="info-label">Jenis Kelamin</span>
                            <span class="info-value">{{ $detail->gender ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="info-group mt-3">
                    <span class="info-label">Tentang {{ $detail->nama }}</span>
                    <div class="pet-description">
                        {{ $detail->deskripsi ?? 'Tidak ada deskripsi untuk hewan ini.' }}
                    </div>
                </div>

</form>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">Ups! Detail hewan tidak ditemukan.</h4>
            <a href="{{ route('user.index') }}" class="btn btn-pet mt-3">Kembali</a>
        </div>
    @endif
</div>

@endsection