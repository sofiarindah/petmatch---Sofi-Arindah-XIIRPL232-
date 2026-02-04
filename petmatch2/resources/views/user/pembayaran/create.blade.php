@extends('user.layouts.side')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 30px auto;
    }

    .form-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 15px 35px rgba(139, 115, 85, 0.05);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header i {
        font-size: 40px;
        color: #967e76;
        margin-bottom: 10px;
        display: block;
    }

    .form-header h4 {
        font-weight: 800;
        color: #634832;
        margin-bottom: 5px;
    }

    .form-label {
        font-weight: 700;
        font-size: 13px;
        color: #7d5a50;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .custom-input {
        background: #fdf8f5 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px !important;
        padding: 12px 18px !important;
        color: #5d4037 !important;
        transition: 0.3s;
    }

    .custom-input:focus {
        border-color: #dbc1ac !important;
        box-shadow: 0 0 0 4px rgba(219, 193, 172, 0.15) !important;
        background: #ffffff !important;
    }

    .input-group-text {
        background: #f3e9e2 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px 0 0 15px !important;
        color: #967e76;
        font-weight: 700;
    }

    .input-group .custom-input {
        border-radius: 0 15px 15px 0 !important;
    }

    .btn-save {
        background: #967e76 !important;
        color: white !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 14px !important;
        font-weight: 800 !important;
        width: 100%;
        margin-top: 20px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-save:hover {
        background: #634832 !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 72, 50, 0.2) !important;
    }

    .file-help {
        font-size: 11px;
        color: #a68b7c;
        margin-top: 5px;
        display: block;
    }
</style>

<div class="container py-4">
    <div class="form-container">
        
        {{-- Tombol Kembali --}}
        <a href="{{ route('user-pembayaran.index') }}" class="btn btn-link text-decoration-none text-muted mb-3 p-0">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
        </a>

        <div class="form-card">
            <div class="form-header">
                <i class="bi bi-wallet2"></i>
                <h4>Konfirmasi Bayar</h4>
                <p class="text-muted small">Silakan isi detail pembayaran Anda di bawah ini</p>
            </div>

<form action="{{ route('user-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- PILIH PERMINTAAN -->
    <div class="mb-4">
        <label class="form-label">Pilih Permintaan</label>
        <select name="permintaan_id" class="form-control custom-input" required>
            <option value="">Pilih</option>
            @foreach ($permintaans as $permintaan)
                <option value="{{ $permintaan->id }}">
                    {{ $permintaan->hewan->nama }} 
                    ({{ $permintaan->created_at->format('d M Y') }})
                </option>
            @endforeach
        </select>
    </div>

    <!-- JUMLAH PEMBAYARAN -->
    <div class="mb-4">
        <label class="form-label">Jumlah Pembayaran</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" name="jumlah" class="form-control custom-input" placeholder="Minimal Rp 100.000" required>
        </div>
    </div>

    <!-- BUKTI PEMBAYARAN -->
    <div class="mb-4">
        <label class="form-label">Bukti Penerimaan Adopsi</label>
        <input type="file" name="bukti" class="form-control custom-input">
        <span class="file-help">Format: JPG, PNG, PDF (Maks. 2MB). Kosongkan jika belum ada.</span>
    </div>

    <!-- TOMBOL SUBMIT -->
    <button type="submit" class="btn btn-save">
        Kirim Konfirmasi
    </button>
</form>

        </div>
    </div>
</div>
@endsection