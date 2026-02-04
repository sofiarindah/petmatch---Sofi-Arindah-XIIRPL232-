@extends('admin.layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

<style>
    /* CSS ini akan memaksa tampilan berubah ke Coklat Pastel */
    #adoption-page-wrapper {
        background: #fdf8f5 !important;
        font-family: 'Poppins', sans-serif !important;
        padding: 40px 20px;
        min-height: 100vh;
    }

    .admin-card-custom {
        background: #ffffff !important;
        border-radius: 30px !important;
        box-shadow: 0 15px 35px rgba(139, 115, 85, 0.1) !important;
        border: 2px solid #f3e9e2 !important;
        padding: 30px !important;
    }

    .title-area {
        margin-bottom: 30px;
        border-left: 6px solid #dbc1ac;
        padding-left: 15px;
    }

    .page-title-text {
        color: #634832 !important;
        font-weight: 800 !important;
        margin: 0;
    }

    /* Tabel Melayang */
    .table-custom {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        width: 100%;
    }

    .table-custom thead th {
        background-color: #f3e9e2 !important;
        color: #7d5a50 !important;
        border: none !important;
        padding: 15px !important;
        font-size: 0.8rem !important;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-custom tbody tr {
        background-color: #ffffff !important;
        transition: transform 0.2s ease;
    }

    .table-custom tbody tr:hover {
        transform: scale(1.01);
        background-color: #fffaf7 !important;
    }

    .table-custom td {
        padding: 15px !important;
        border-top: 1px solid #f3e9e2 !important;
        border-bottom: 1px solid #f3e9e2 !important;
        vertical-align: middle !important;
        color: #5d4037 !important;
    }

    .table-custom td:first-child { border-left: 1px solid #f3e9e2 !important; border-radius: 15px 0 0 15px !important; }
    .table-custom td:last-child { border-right: 1px solid #f3e9e2 !important; border-radius: 0 15px 15px 0 !important; }

    /* Badge & Button */
    .status-badge {
        padding: 6px 14px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        display: inline-block;
    }
    .badge-p { background: #ffe5d9; color: #d4a373; } /* Pending */
    .badge-a { background: #e2f0d9; color: #66bb6a; } /* Accepted */
    .badge-r { background: #f8d7da; color: #dc3545; } /* Rejected */

    .btn-milk-tea {
        background: #967e76 !important;
        color: #fff !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 6px 15px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
    }

    .btn-milk-tea:hover { background: #634832 !important; }

    .btn-soft {
        background: #ece0d1 !important;
        color: #7d5a50 !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 6px 15px !important;
        font-weight: 600 !important;
    }
</style>

<div id="adoption-page-wrapper">
    <div class="admin-card-custom">
        <div class="title-area">
            <h4 class="page-title-text">Data Permintaan Adopsi</h4>
            <small class="text-muted">Kelola persetujuan adopsi calon pemilik hewan</small>
        </div>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Pemohon</th>
                        <th>Hewan</th>
                        <th>Identitas</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permintaans as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->user->name }}</td>
                        <td>
                            <span style="background: #fdf8f5; padding: 5px 12px; border-radius: 10px; border: 1px solid #f3e9e2;">
                                {{ $p->hewan->nama }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">
                                <strong>{{ $p->nama_lengkap }}</strong><br>
                                <span class="text-muted">{{ $p->no_hp }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.8rem; max-width: 250px;">
                                <span class="text-dark">{{ Str::limit($p->alamat, 50) }}</span><br>
                                <span class="text-muted italic">"{{ Str::limit($p->alasan, 50) }}"</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge 
                                @if($p->status=='diajukan') badge-p
                                @elseif($p->status=='diterima') badge-a
                                @else badge-r
                                @endif">
                                {{ strtoupper($p->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'diajukan')
                                <div class="d-flex gap-2 justify-content-center">
                                    <form method="POST" action="{{ route('admin.permintaan.terima', $p->id) }}">
                                        @csrf
                                        <button class="btn btn-milk-tea">Terima</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.permintaan.tolak', $p->id) }}">
                                        @csrf
                                        <button class="btn btn-soft">Tolak</button>
                                    </form>
                                </div>
                            @else
                                <span style="font-size: 0.75rem; color: #dbc1ac; font-weight: bold;">ARSIP</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada permintaan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection