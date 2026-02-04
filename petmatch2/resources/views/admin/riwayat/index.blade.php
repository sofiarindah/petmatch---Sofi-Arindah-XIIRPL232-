@extends('admin.layouts.app')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
    }

    .custom-card {
        background: #ffffff;
        border-radius: 25px;
        border: none;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.08);
        padding: 30px;
    }

    .card-title-custom {
        color: #634832;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    /* Table Enhancements */
    .table-container {
        border-radius: 20px;
        margin-top: 25px;
    }

    .table {
        border-collapse: separate;
        border-spacing: 0 8px; /* Memberi jarak antar baris */
    }

    .table thead th {
        background-color: transparent !important;
        color: #a68b7c;
        border: none;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        padding: 15px;
    }

    .table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: transform 0.2s ease;
    }

    .table tbody tr:hover {
        transform: scale(1.01);
        background-color: #fcfaf9;
    }

    .table tbody td {
        padding: 18px 15px;
        color: #5d4037;
        vertical-align: middle;
        border-top: 1px solid #f3e9e2 !important;
        border-bottom: 1px solid #f3e9e2 !important;
    }

    .table tbody td:first-child {
        border-left: 1px solid #f3e9e2 !important;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .table tbody td:last-child {
        border-right: 1px solid #f3e9e2 !important;
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    /* Status Badge Styling */
    .badge-status-selesai {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .badge-status-batal {
        background: #ffebee;
        color: #c62828;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .text-email {
        font-size: 0.8rem;
        color: #a68b7c;
        font-weight: 400;
    }

    .hewan-name {
        color: #634832;
        font-weight: 700;
        font-size: 0.95rem;
    }

    /* Customizing DataTables Search */
    .dataTables_filter input {
        border-radius: 10px !important;
        border: 1px solid #f3e9e2 !important;
        padding: 6px 12px !important;
        background: #fdf8f5 !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="custom-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4 class="card-title-custom m-0">Riwayat Adopsi</h4>
            <span class="badge bg-soft-brown text-muted small px-3 py-2 rounded-pill" style="background: #f3e9e2;">
                Total: {{ $riwayats->count() }} Data
            </span>
        </div>
        <p class="text-muted small">Pantau semua status adopsi yang telah diproses.</p>

        <div class="table-container text-nowrap">
            <div class="table-responsive">
                <table id="datatable" class="table align-middle border-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Hewan</th>
                            <th>Jenis</th>
                            <th>Pengadopsi</th>
                            <th>Kontak</th>
                            <th>Tanggal</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($riwayats as $item)
                            <tr>
                                <td class="text-center text-muted fw-bold" style="font-size: 0.8rem;">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span class="hewan-name">{{ $item->hewan->nama ?? '-' }}</span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill px-3 py-2" style="background: #fdf8f5; color: #967e76; border: 1px solid #f3e9e2;">
                                        {{ $item->hewan->jenis ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="fw-bold" style="color: #634832;">{{ $item->user->name ?? '-' }}</div>
                                </td>

                                <td>
                                    <div class="text-email"><i class="bi bi-envelope me-1"></i> {{ $item->user->email ?? '-' }}</div>
                                </td>

                                <td class="text-muted" style="font-size: 0.85rem;">
                                    {{ $item->created_at->format('d M, Y') }}
                                </td>

                                <td class="text-center">
                                    @if ($item->status === 'diterima')
                                        <span class="badge-status-selesai">
                                            <i class="bi bi-check2-circle me-1"></i> SELESAI
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="badge-status-batal">
                                            <i class="bi bi-x-circle me-1"></i> BATAL
                                        </span>
                                    @else
                                        <span class="text-muted small italic">Diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-transparent shadow-none">
                                <td colspan="7" class="text-center text-muted py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="mb-3 opacity-25"><br>
                                    <span class="fw-bold">Belum ada riwayat adopsi</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari riwayat...",
                lengthMenu: "_MENU_ per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Data kosong",
                paginate: {
                    next: '<i class="bi bi-chevron-right"></i>',
                    previous: '<i class="bi bi-chevron-left"></i>'
                }
            }
        });
    });
</script>
@endpush