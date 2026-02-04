@extends('user.layouts.side')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
    }
    .pastel-card {
        background: #ffffff;
        border-radius: 30px;
        box-shadow: 0 15px 35px rgba(139, 115, 85, 0.1);
        border: 2px solid #f3e9e2;
        transition: transform 0.3s ease;
    }
    .pastel-card:hover {
        transform: translateY(-5px);
    }
    .bubble-title {
        background: #ece0d1;
        color: #634832;
        display: inline-block;
        padding: 10px 22px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 3px 3px 0px #dbc1ac;
        margin-bottom: 10px;
    }
    .form-control, .form-select {
        border-radius: 18px;
        border: 2px solid #f3e9e2;
        padding: 12px 18px;
        background-color: #fffaf7;
    }
    .form-control:focus, .form-select:focus {
        border-color: #dbc1ac;
        box-shadow: 0 0 0 0.25rem rgba(219, 193, 172, 0.25);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 700;
        color: #7d5a50;
        margin-left: 10px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-pastel {
        border-radius: 50px;
        font-weight: 800;
        padding: 12px 30px;
        background: #967e76;
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(150, 126, 118, 0.4);
        transition: all 0.3s;
    }
    .btn-pastel:hover {
        background: #634832;
        color: white;
        transform: scale(1.05);
    }
    .table {
        border-radius: 20px;
        overflow: hidden;
    }
    .table thead {
        background: #f3e9e2;
        color: #7d5a50;
    }
    .table thead th {
        border: none;
        font-weight: 700;
    }
    .badge {
        border-radius: 12px;
        padding: 8px 16px;
        font-weight: 600;
    }
    .badge-pending { background-color: #ffe5d9; color: #d4a373; }
    .badge-diterima { background-color: #e2f0d9; color: #70a1ff; }
</style>

<div class="container py-4">

    {{-- FORM PERMINTAAN --}}
    <div class="pastel-card p-4 p-md-5 mb-5">
        <span class="bubble-title">Permintaan Adopsi</span>

        <p class="text-muted mt-3 mb-4" style="font-style: italic;">
            "Rumah yang hangat dimulai dari teman bulu yang bahagia." <br>
            Silakan isi formulir di bawah dengan penuh kasih sayang! 
        </p>

        <form method="POST" action="{{ route('user.permintaan.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Pilih Nama Hewan Yang Ingin Diadopsi</label>
                    <select name="hewan_id" class="form-select" required>
                        <option value="">Pilih Hewan</option>
                        @foreach($hewans as $h)
                            <option value="{{ $h->id }}">{{ $h->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">No. WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="08123xxx" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan/Kesibukan" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Tuliskan alamat lengkap" required></textarea>
            </div>

            <div class="mb-5">
                <label class="form-label">Alasan Adopsi</label>
                <textarea name="alasan" class="form-control" rows="3" placeholder="Ceritakan alasan kenapa anda ingin mengadopsi hewan ini..." required></textarea>
            </div>

            <div class="text-center">
                <button class="btn btn-pastel btn-lg w-100 w-md-auto">Kirim Permintaan</button>
            </div>
        </form>
    </div>

    {{-- RIWAYAT PERMINTAAN --}}
    <div class="pastel-card p-4 p-md-5">
        <span class="bubble-title">Riwayat Permintaan</span>

        <div class="table-responsive">
            <table class="table mt-4 align-middle text-center">
                <thead>
                    <tr>
                        <th class="py-3">Hewan</th>
                        <th class="py-3">Status Kabar</th>
                        <th class="py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($permintaans as $p)
                    <tr>
                        <td class="fw-bold text-secondary">{{ $p->hewan->nama }}</td>
                        <td>
                            <span class="badge 
                                @if($p->status=='diajukan') badge-pending
                                @elseif($p->status=='diterima') badge-diterima
                                @else bg-danger text-white
                                @endif">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if($p->status === 'diterima')
                                <a href="{{ route('user.permintaan.nota', $p->id) }}" class="btn btn-success btn-sm">
                                    Lihat Nota
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-5 text-muted">
                            <div class="mb-2" style="font-size: 2rem;"></div>
                            Belum ada jejak permintaan adopsi nih..
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
