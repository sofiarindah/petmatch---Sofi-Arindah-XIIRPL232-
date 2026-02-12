@extends('user.layouts.side')

@section('content')
<style>
    /* Style untuk tampilan Layar */
    .nota-card {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        border-radius: 30px;
        padding: 40px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 15px 35px rgba(139, 115, 85, 0.05);
        position: relative;
        overflow: hidden;
    }

    .nota-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: #967e76;
    }

    /* Tombol Kembali Menjadi Button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        background-color: #f3e9e2 !important;
        color: #634832 !important;
        border: 1px solid #e5d5c8 !important;
        border-radius: 12px !important;
        padding: 10px 20px !important;
        font-weight: 700 !important;
        font-size: 14px;
        text-decoration: none !important;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .btn-back:hover {
        background-color: #967e76 !important;
        color: white !important;
        border-color: #967e76 !important;
        transform: translateX(-5px);
    }

    .nota-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .nota-header h4 {
        font-weight: 800;
        color: #634832;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 5px;
    }

    .nota-header p {
        color: #a68b7c;
        font-size: 13px;
    }

    .nota-table {
        width: 100%;
        margin-bottom: 30px;
    }

    .nota-table tr {
        border-bottom: 1px dashed #f3e9e2;
    }

    .nota-table th {
        padding: 15px 0;
        color: #a68b7c;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
        width: 40%;
    }

    .nota-table td {
        padding: 15px 0;
        color: #5d4037;
        font-weight: 700;
        text-align: right;
    }

    .status-stamp {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 10px;
        font-size: 12px;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .stamp-success { background: #ebfbee; color: #2b8a3e; border: 1px solid #d3f9d8; }
    .stamp-warning { background: #fff9db; color: #f59f00; border: 1px solid #fff3bf; }

    .btn-print {
        background: #967e76 !important;
        color: white !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 12px 25px !important;
        font-weight: 700 !important;
        transition: 0.3s;
    }

    .btn-print:hover {
        background: #634832 !important;
        transform: translateY(-2px);
    }

    /* Style Khusus Cetak/Print */
    @media print {
        .sidebar, .btn-print, .btn-back, .navbar {
            display: none !important;
        }
        .content {
            margin: 0 !important;
            padding: 0 !important;
        }
        body {
            background: white !important;
        }
        .nota-card {
            box-shadow: none !important;
            border: 1px solid #eee !important;
            margin: 0 auto !important;
            max-width: 100% !important;
        }
    }
</style>

<div class="container py-4">
    {{-- Tombol Kembali Berbentuk Button --}}
    <a href="{{ route('user-pembayaran.index') }}" class="btn btn-back">
        Kembali
    </a>

    <div class="nota-card">
        <div class="nota-header">
            <img src="https://cdn-icons-png.flaticon.com/512/194/194279.png" width="50" class="mb-2">
            <h4>Nota Pembayaran</h4>
            <p>Terima kasih telah mendukung <strong>PetMatch</strong></p>
        </div>

        <table class="nota-table">
            <tr>
                <th>KODE TRANSAKSI</th>
                <td>#{{ $pembayaran->kode_pembayaran }}</td>
            </tr>
            @if($pembayaran->permintaan && $pembayaran->permintaan->hewan)
            <tr>
                <th>HEWAN ADOPSI</th>
                <td>
                    <span>{{ $pembayaran->permintaan->hewan->nama }}</span>
                </td>
            </tr>
            @endif
            <tr>
                <th>TANGGAL</th>
                <td>{{ $pembayaran->created_at->format('d M Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <th>METODE PEMBAYARAN</th>
                <td>{{ ucfirst($pembayaran->metode_pembayaran ?? '-') }}</td>
            </tr>
            <tr>
                <th>JUMLAH</th>
                <td style="font-size: 20px; color: #634832;">Rp {{ number_format($pembayaran->jumlah,0,',','.') }}</td>
            </tr>
            <tr>
                <th>STATUS</th>
                <td>
                    <span class="status-stamp {{ $pembayaran->status == 'diterima' ? 'stamp-success' : 'stamp-warning' }}">
                        {{ strtoupper($pembayaran->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="text-center mt-4">
            <p class="small text-muted mb-4">Nota ini dihasilkan secara otomatis dan sah sebagai bukti pembayaran yang dilakukan di platform PetMatch.</p>
            
            <button onclick="window.print()" class="btn btn-print">
                <i class="bi bi-printer me-2"></i> Cetak Nota Sekarang
            </button>
        </div>
    </div>
</div>
@endsection
