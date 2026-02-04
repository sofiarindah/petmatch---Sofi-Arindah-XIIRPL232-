@extends('admin.layouts.app')

@section('content')
<style>
    /* Menggunakan palet coklat pastel yang konsisten */
    :root {
        --brown-main: #967e76;
        --brown-dark: #634832;
        --brown-light: #dbc1ac;
        --bg-soft: #fdf8f5;
    }

    .admin-card {
        background: white;
        border-radius: 24px;
        border: 1px solid #f3e9e2;
        box-shadow: 0 10px 40px rgba(150, 126, 118, 0.05);
        overflow: hidden;
    }

    .table thead th {
        background: #fcfaf9;
        color: var(--brown-main);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 800;
        padding: 20px 15px;
        border-bottom: 2px solid #f3e9e2;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #fdfdfd;
    }

    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f8f3f0;
        color: #5d4037;
    }

    /* User Avatar Style */
    .user-avatar {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, var(--brown-light) 0%, #bd9e86 100%);
        color: white;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(219, 193, 172, 0.3);
    }

    /* Action Buttons */
    .btn-action {
        padding: 8px 18px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s;
        border: none;
    }

    .btn-terima {
        background-color: #ebfbee;
        color: #2b8a3e;
    }

    .btn-terima:hover {
        background-color: #2b8a3e;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(43, 138, 62, 0.2);
    }

    .btn-tolak {
        background-color: #fff5f5;
        color: #c92a2a;
    }

    .btn-tolak:hover {
        background-color: #c92a2a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 42, 42, 0.2);
    }

    /* Status Badge Enhancements */
    .badge-status {
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.8px;
    }

    code.transaction-code {
        background: #f3e9e2;
        color: var(--brown-dark);
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--brown-dark); letter-spacing: -0.5px;">Manajemen Pembayaran</h4>
            <p class="text-muted small mb-0">Verifikasi bukti transaksi finansial dari pengadopsi</p>
        </div>
        <div class="badge bg-white text-muted border px-3 py-2 rounded-pill shadow-sm small">
            Total: {{ $pembayarans->count() }} Transaksi
        </div>
    </div>

    <div class="card admin-card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Kode Transaksi</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pembayarans as $p)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3">
                                        {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold mb-0" style="color: var(--brown-dark);">{{ $p->user->name }}</div>
                                        <div class="text-muted small" style="font-size: 11px;">Pengadopsi</div>
                                    </div>
                                </div>
                            </td>
                            <td><code class="transaction-code">{{ $p->kode_pembayaran }}</code></td>
                            <td>
                                <span class="fw-bold" style="color: #2d6a4f;">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="badge badge-status bg-{{ 
                                    $p->status == 'diajukan' ? 'warning text-dark' :
                                    ($p->status == 'diterima' ? 'success' : 'danger')
                                }}">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 6px; vertical-align: middle;"></i> 
                                    {{ strtoupper($p->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($p->status == 'diajukan')
                                    <form method="POST" action="{{ route('admin.pembayaran.terima', $p->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-action btn-terima me-1">
                                            <i class="bi bi-check-lg"></i> Terima
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.pembayaran.tolak', $p->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-action btn-tolak">
                                            <i class="bi bi-trash3"></i> Tolak
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small fw-bold">
                                        <i class="bi bi-shield-check text-success"></i> VERIFIED
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
</div>
@endsection