@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --primary-brown: #967e76;
        --dark-brown: #634832;
        --soft-brown: #a68b7c;
        --pastel-bg: #fdf8f5;
    }

    .report-card {
        background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);
        border: none;
        box-shadow: 0 10px 20px rgba(45, 106, 79, 0.15);
        color: white;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
    }

    .filter-card {
        background: white;
        border: 1px solid #f3e9e2;
        border-radius: 15px !important;
    }

    .form-control {
        border-radius: 10px !important;
        border: 1px solid #e5d5c8 !important;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: var(--primary-brown) !important;
        box-shadow: 0 0 0 0.25rem rgba(150, 126, 118, 0.1);
    }

    .btn-filter {
        background-color: var(--primary-brown) !important;
        color: white !important;
        border: none !important;
        border-radius: 10px !important;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-filter:hover {
        background-color: var(--dark-brown) !important;
        transform: translateY(-2px);
    }

    .table-card {
        background: white;
        border: 1px solid #f3e9e2;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .table thead th {
        background-color: #fcfaf9;
        color: var(--soft-brown);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #f3e9e2;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        color: #5d4037;
        border-bottom: 1px solid #f8f3f0;
    }

    .text-amount {
        color: #2d6a4f;
        font-weight: 700;
    }
</style>

<div class="container py-4">
    <h4 class="fw-bold mb-4" style="color: var(--dark-brown);">Laporan Keuangan</h4>

    {{-- TOTAL PEMASUKAN CARD --}}
    <div class="card report-card mb-4 p-4 rounded-4">
        <div class="d-flex align-items-center">
            <div class="me-3 p-3 bg-white bg-opacity-25 rounded-3">
                <i class="bi bi-wallet2 fs-3 text-white"></i>
            </div>
            <div>
                <h6 class="stat-label mb-1">Total Pemasukan</h6>
                <h2 class="fw-bold mb-0">
                    Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                </h2>
            </div>
        </div>
        <div class="mt-3 text-white text-opacity-75 small">
            Diperbarui: {{ now()->format('d M Y, H:i') }} WIB
        </div>
    </div>

    {{-- FILTER TANGGAL & JENIS --}}
    <div class="card filter-card p-3 mb-4 border-0 shadow-sm">
        <form class="row g-3 align-items-end" method="GET" action="{{ route('admin.laporan-keuangan') }}">
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2">Dari Tanggal</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2">Sampai Tanggal</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-2">Jenis Transaksi</label>
                <select name="jenis" class="form-control">
                    <option value="">Semua Jenis</option>
                    <option value="donasi" {{ request('jenis') === 'donasi' ? 'selected' : '' }}>Donasi</option>
                    <option value="adopsi" {{ request('jenis') === 'adopsi' ? 'selected' : '' }}>Adopsi</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <button class="btn btn-filter w-100 py-2" type="submit">
                    <i class="bi bi-funnel me-1"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL DATA --}}
    <div class="card table-card rounded-4 border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pengguna</th>
                        <th>Metode</th>
                        <th>Jenis</th>
                        <th class="text-end">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $item)
                        <tr>
                            <td class="text-center text-muted">{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ now()->format('H:i') }} WIB</td>
                            <td><span class="badge bg-light text-dark border">#{{ $item->kode_pembayaran }}</span></td>
                            <td class="fw-semibold">{{ $item->user->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ ucfirst($item->metode_pembayaran ?? '-') }}
                                </span>
                            </td>
                            <td>
                                @if(!empty($item->permintaan_id))
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Adopsi</span>
                                @else
                                    <span class="badge bg-info bg-opacity-10 text-info">Donasi</span>
                                @endif
                            </td>
                            <td class="text-end text-amount">
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Tidak ada data pemasukan dalam periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
