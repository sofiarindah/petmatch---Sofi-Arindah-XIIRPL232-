@extends('user.layouts.side')

@section('content')
<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-weight: 800;
        color: #634832;
        margin-bottom: 5px;
    }

    .btn-add {
        background: #967e76 !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(150, 126, 118, 0.2);
    }

    .btn-add:hover {
        background: #634832 !important;
        transform: translateY(-2px);
    }

    /* Card Wrapper */
    .table-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.05);
    }

    /* Table Styling */
    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background: #fffaf7 !important;
        color: #a68b7c;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        padding: 15px;
    }

    .custom-table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        color: #5d4037;
        border-bottom: 1px solid #fdf8f5;
    }

    /* Badge Custom */
    .badge-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 11px;
    }

    .btn-nota {
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        border: 2px solid #967e76;
        color: #967e76;
        transition: 0.3s;
    }

    .btn-nota:hover {
        background: #967e76;
        color: white;
    }

    .waiting-text {
        color: #a68b7c;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <div class="page-header d-flex justify-content-between align-items-end">
        <div>
            <h3 class="page-title">Riwayat Pembayaran</h3>
            <p class="text-muted small mb-0">Pantau status transaksi adopsi dan donasi Anda.</p>
        </div>
        <a href="{{ route('user-pembayaran.create') }}" class="btn btn-add">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pembayaran
        </a>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th class="text-center">Aksi / Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $p)
                    <tr>
                        <td>
                            <span class="fw-bold text-dark">#{{ $p->kode_pembayaran }}</span>
                        </td>
                        <td>{{ $p->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="fw-bold" style="color: #634832;">
                                Rp {{ number_format($p->jumlah,0,',','.') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusColor = match($p->status) {
                                    'diterima' => 'success',
                                    'ditolak' => 'danger',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge badge-status bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }}">
                                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                                {{ strtoupper($p->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'diterima')
                                <a href="{{ route('user-pembayaran.nota', $p->id) }}" class="btn btn-sm btn-nota">
                                    <i class="bi bi-file-earmark-text me-1"></i> Lihat Nota
                                </a>
                            @elseif($p->status == 'pending' || $p->status == 'diajukan')
                                <span class="waiting-text">
                                    <i class="bi bi-clock-history me-1"></i> Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="text-danger small fw-bold">
                                    <i class="bi bi-x-circle me-1"></i> Pembayaran Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection