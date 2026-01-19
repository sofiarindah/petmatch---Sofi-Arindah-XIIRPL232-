@extends('admin.layouts.app')

@section('content')
<style>
    .admin-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }

    .table thead th {
        background: #f8f9fa;
        color: #7d5a50;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        padding: 15px;
        border: none;
    }

    .table tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
        color: #4a3b2b;
    }

    /* User Avatar Initial */
    .user-avatar {
        width: 35px;
        height: 35px;
        background: #dbc1ac;
        color: white;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        margin-right: 10px;
    }

    /* Action Buttons */
    .btn-action {
        padding: 6px 16px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        transition: 0.2s;
    }

    .btn-terima {
        background-color: #ebfbee;
        color: #2b8a3e;
        border: 1px solid #d3f9d8;
    }

    .btn-terima:hover {
        background-color: #40c057;
        color: white;
    }

    .btn-tolak {
        background-color: #fff5f5;
        color: #c92a2a;
        border: 1px solid #ffe3e3;
    }

    .btn-tolak:hover {
        background-color: #fa5252;
        color: white;
    }

    /* Custom Badge */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #634832;">Manajemen Pembayaran</h4>
            <p class="text-muted small">Verifikasi bukti transfer dari para pengadopsi</p>
        </div>
    </div>

    <div class="card admin-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
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
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                    </div>
                                    <div class="fw-bold">{{ $p->user->name }}</div>
                                </div>
                            </td>
                            <td><code class="text-muted">{{ $p->kode_pembayaran }}</code></td>
                            <td class="fw-bold">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-status bg-{{ 
                                    $p->status == 'diajukan' ? 'warning text-dark' :
                                    ($p->status == 'diterima' ? 'success' : 'danger')
                                }}">
                                    <i class="bi bi-dot"></i> {{ strtoupper($p->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($p->status == 'diajukan')
                                    <form method="POST" action="{{ route('admin.pembayaran.terima', $p->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-action btn-terima">
                                            <i class="bi bi-check2-circle me-1"></i> Terima
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.pembayaran.tolak', $p->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-action btn-tolak">
                                            <i class="bi bi-x-circle me-1"></i> Tolak
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-light text-muted p-2" style="border-radius: 8px;">
                                        <i class="bi bi-check-all"></i> Terverifikasi
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