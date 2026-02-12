@extends('user.layouts.side')

@section('content')
<style>
    .transfer-card {
        max-width: 680px;
        margin: 20px auto;
        background: #fff;
        border-radius: 24px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 10px 25px rgba(139,115,85,0.08);
        overflow: hidden;
    }
    .transfer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        background: #fffaf7;
        border-bottom: 1px solid #f3e9e2;
    }
    .title {
        font-weight: 800;
        color: #634832;
        letter-spacing: .5px;
    }
    .type-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid #e9e3de;
        color: #634832;
        background: #fdf8f5;
    }
    .transfer-body {
        padding: 24px;
    }
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #efe6e0;
        font-size: 14px;
    }
    .info-item .label {
        color: #a68b7c;
        font-weight: 600;
    }
    .info-item .value {
        color: #5d4037;
        font-weight: 700;
    }
    .bank-box {
        background: #eef7ff;
        border: 1px dashed #aecce8;
        padding: 12px 16px;
        border-radius: 16px;
        margin-top: 12px;
        font-size: 13px;
    }
    .btn-print {
        background: #967e76 !important;
        color: #fff !important;
        border: none;
        border-radius: 14px;
        padding: 10px 18px;
        font-weight: 700;
    }
    .upload-preview {
        margin-top: 16px;
        border: 1px solid #eee;
        border-radius: 12px;
        overflow: hidden;
    }
    .upload-preview img {
        width: 100%;
        display: block;
    }
    @media print {
        .sidebar, .navbar, .btn-print, .btn-back {
            display: none !important;
        }
        body { background: #fff !important; }
        .transfer-card { border: 1px solid #eee !important; box-shadow: none !important; }
    }
</style>

<div class="container py-4">
    <a href="{{ route('user-pembayaran.index') }}" class="btn btn-back mb-3" style="background:#f3e9e2;color:#634832;border:1px solid #e5d5c8;border-radius:12px;font-weight:700;">
        Kembali
    </a>

    <div class="transfer-card">
        <div class="transfer-header">
            <div class="d-flex align-items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/194/194279.png" width="28">
                <div class="title">Bukti Transfer</div>
            </div>
            <span class="type-badge">
                {{ $pembayaran->permintaan_id ? 'Adopsi' : 'Donasi' }}
            </span>
        </div>

        <div class="transfer-body">
            <ul class="info-list">
                <li class="info-item">
                    <span class="label">Kode Pembayaran</span>
                    <span class="value">#{{ $pembayaran->kode_pembayaran }}</span>
                </li>
                <li class="info-item">
                    <span class="label">Nama</span>
                    <span class="value">{{ $pembayaran->user->name }}</span>
                </li>
                <li class="info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $pembayaran->user->email }}</span>
                </li>
                @if($pembayaran->permintaan && $pembayaran->permintaan->hewan)
                <li class="info-item">
                    <span class="label">Hewan</span>
                    <span class="value">{{ $pembayaran->permintaan->hewan->nama }}</span>
                </li>
                @endif
                <li class="info-item">
                    <span class="label">Tanggal</span>
                    <span class="value">{{ $pembayaran->created_at->format('d M Y, H:i') }} WIB</span>
                </li>
                <li class="info-item">
                    <span class="label">Jumlah</span>
                    <span class="value">Rp {{ number_format($pembayaran->jumlah,0,',','.') }}</span>
                </li>
                <li class="info-item">
                    <span class="label">Metode</span>
                    <span class="value">{{ ucfirst($pembayaran->metode_pembayaran) }}</span>
                </li>
            </ul>

            <div class="bank-box">
                <div class="fw-bold text-primary">Rekening Tujuan</div>
                <div>BCA 1234567890 a.n PetMatch</div>
                <div class="mt-1 text-muted">Gunakan kode pembayaran sebagai berita transfer.</div>
            </div>

            @if($pembayaran->bukti)
                <div class="upload-preview">
                    <img src="{{ asset('storage/'.$pembayaran->bukti) }}" alt="Bukti Transfer Terunggah">
                </div>
            @endif

            <div class="text-end mt-3">
                <button onclick="window.print()" class="btn btn-print">
                    <i class="bi bi-printer me-1"></i> Cetak / Simpan PDF
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
