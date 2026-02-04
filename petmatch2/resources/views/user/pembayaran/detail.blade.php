@extends('user.layouts.side')

@section('content')
<style>
    :root {
        --brown-main: #967e76;
        --brown-dark: #634832;
        --brown-light: #a68b7c;
        --brown-pastel: #fdf8f5;
        --bg-soft: #fcfaf9;
    }

    .detail-title {
        color: var(--brown-dark);
        letter-spacing: 1px;
    }

    .info-card {
        background: white;
        border: 1px solid #f3e9e2;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px rgba(150, 126, 118, 0.05);
        height: 100%;
    }

    .info-header {
        border-bottom: 2px solid var(--brown-pastel);
        padding-bottom: 10px;
        margin-bottom: 20px;
        color: var(--brown-light);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .info-table th {
        font-weight: 500;
        color: var(--brown-light);
        width: 35%;
        font-size: 0.9rem;
        padding-bottom: 12px;
    }

    .info-table td {
        font-weight: 700;
        color: var(--brown-dark);
        font-size: 0.9rem;
        padding-bottom: 12px;
    }

    .status-badge-custom {
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        display: inline-block;
    }

    .bg-status-success { background: #ebfbee; color: #2b8a3e; }
    .bg-status-warning { background: #fff9db; color: #f59f00; }
    .bg-status-danger { background: #fff5f5; color: #fa5252; }

    /* Tombol Kembali Custom */
    .btn-back-custom {
        background-color: #f3e9e2 !important;
        color: var(--brown-dark) !important;
        border-radius: 12px !important;
        padding: 10px 20px !important;
        font-weight: 700 !important;
        border: none !important;
        transition: 0.3s;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
    }

    .btn-back-custom:hover {
        background-color: var(--brown-main) !important;
        color: white !important;
        transform: translateX(-5px);
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold detail-title mb-0">Detail Pembayaran</h3>
        {{-- Status Badge di Pojok --}}
        <div class="status-badge-custom 
            {{ $pembayaran->status == 'diterima' ? 'bg-status-success' : ($pembayaran->status == 'ditolak' ? 'bg-status-danger' : 'bg-status-warning') }}">
            <i class="bi bi-dot"></i> {{ strtoupper($pembayaran->status) }}
        </div>
    </div>

    <div class="row g-4">
        {{-- INFO PEMBAYARAN --}}
        <div class="col-md-6">
            <div class="card info-card p-4 border-0">
                <div class="info-header fw-bold">
                    <i class="bi bi-receipt me-2"></i> Transaksi
                </div>
                <table class="info-table w-100">
                    <tr>
                        <th>Kode</th>
                        <td>#{{ $pembayaran->kode_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $pembayaran->created_at->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ $pembayaran->created_at->format('H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td class="fs-5" style="color: var(--brown-main);">Rp {{ number_format($pembayaran->jumlah,0,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- INFO PENGADOPSI --}}
        <div class="col-md-6">
            <div class="card info-card p-4 border-0">
                <div class="info-header fw-bold">
                    <i class="bi bi-person-check me-2"></i> Data Pengadopsi
                </div>
                <table class="info-table w-100">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pembayaran->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="text-lowercase">{{ $pembayaran->user->email }}</td>
                    </tr>
                    @if($pembayaran->permintaan)
                    <tr>
                        <th>No HP</th>
                        <td>{{ $pembayaran->permintaan->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pembayaran->permintaan->alamat }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ route('user-pembayaran.index') }}" class="btn-back-custom">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Riwayat
        </a>
    </div>
</div>
@endsection