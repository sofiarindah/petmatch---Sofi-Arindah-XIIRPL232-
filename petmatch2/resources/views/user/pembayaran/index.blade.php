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

    .table-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.05);
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

    .btn-detail {
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
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
            <h3 class="page-title">Pembayaran</h3>
            <p class="text-muted small mb-0">Pantau status transaksi adopsi anda.</p>
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
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $permintaans)
                    <tr>
                        <td class="fw-bold text-dark">
                            #{{ $permintaans->kode_pembayaran }}
                        </td>

                        <td>{{ $permintaans->created_at->format('d M Y') }}</td>

                        <td class="fw-bold" style="color: #634832;">
                            Rp {{ number_format($permintaans->jumlah,0,',','.') }}
                        </td>

                        <td>
                            @php
                                $statusColor = match($permintaans->status) {
                                    'diterima' => 'success',
                                    'ditolak' => 'danger',
                                    default => 'warning'
                                };
                            @endphp

                            <span class="badge badge-status bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }}">
                                {{ strtoupper($permintaan->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{-- 🔥 TOMBOL DETAIL (SELALU ADA) --}}
                            <a href="{{ route('user-pembayaran.detail', $permintaan->id) }}"
                               class="btn btn-sm btn-outline-primary btn-detail mb-1">
                                <i class="bi bi-eye"></i> Detail
                            </a>

                            {{-- NOTA HANYA JIKA DITERIMA --}}
                            @if($permintaan->status === 'diterima')
                                <a href="{{ route('user-pembayaran.nota', $permintaan->id) }}"
                                   class="btn btn-sm btn-nota ms-1">
                                    <i class="bi bi-file-earmark-text"></i> Nota
                                </a>
                            @elseif($permintaan->status === 'diajukan')
                                <div class="waiting-text mt-1">
                                    <i class="bi bi-clock-history me-1"></i> Menunggu Konfirmasi
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            Belum ada riwayat pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
