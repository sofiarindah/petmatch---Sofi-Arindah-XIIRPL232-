@extends('user.layouts.side')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 30px auto;
    }

    .form-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 15px 35px rgba(139, 115, 85, 0.05);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header i {
        font-size: 40px;
        color: #967e76;
        margin-bottom: 10px;
        display: block;
    }

    .form-header h4 {
        font-weight: 800;
        color: #634832;
        margin-bottom: 5px;
    }

    .form-label {
        font-weight: 700;
        font-size: 13px;
        color: #7d5a50;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .custom-input {
        background: #fdf8f5 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px !important;
        padding: 12px 18px !important;
        color: #5d4037 !important;
        transition: 0.3s;
    }

    .custom-input:focus {
        border-color: #dbc1ac !important;
        box-shadow: 0 0 0 4px rgba(219, 193, 172, 0.15) !important;
        background: #ffffff !important;
    }

    .input-group-text {
        background: #f3e9e2 !important;
        border: 2px solid #f3e9e2 !important;
        border-radius: 15px 0 0 15px !important;
        color: #967e76;
        font-weight: 700;
    }

    .input-group .custom-input {
        border-radius: 0 15px 15px 0 !important;
    }

    .btn-save {
        background: #967e76 !important;
        color: white !important;
        border: none !important;
        border-radius: 15px !important;
        padding: 14px !important;
        font-weight: 800 !important;
        width: 100%;
        margin-top: 20px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-save:hover {
        background: #634832 !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 72, 50, 0.2) !important;
    }

    .file-help {
        font-size: 11px;
        color: #a68b7c;
        margin-top: 5px;
        display: block;
    }
</style>

<div class="container py-4">
    <div class="form-container">
        
        {{-- Tombol Kembali --}}
        <a href="{{ route('user-pembayaran.index') }}" class="btn btn-link text-decoration-none text-muted mb-3 p-0">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
        </a>

        <div class="form-card">
            <div class="form-header">
                <i class="bi bi-wallet2"></i>
                <h4>Konfirmasi Bayar</h4>
            <p class="text-muted small">Silakan isi detail pembayaran Anda di bawah ini</p>
            </div>

<form action="{{ route('user-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- JENIS PEMBAYARAN -->
    <div class="mb-4">
        <label class="form-label">Jenis Pembayaran</label>
        <select name="jenis" id="jenis" class="form-control custom-input" onchange="toggleJenis()">
            <option value="adopsi">Adopsi</option>
            <option value="donasi">Donasi</option>
        </select>
    </div>

    <!-- PILIH PERMINTAAN -->
    <div class="mb-4" id="blok-permintaan">
        <label class="form-label">Pilih Permintaan</label>
        <select name="permintaan_id" id="permintaan_id" class="form-control custom-input">
            <option value="">Pilih Hewan yang Diadopsi</option>
            @foreach ($permintaans as $permintaan)
                <option value="{{ $permintaan->id }}">
                    {{ $permintaan->hewan->nama }} ({{ $permintaan->created_at->format('d M Y') }})
                </option>
            @endforeach
        </select>
    </div>

    <!-- METODE PEMBAYARAN -->
    <div class="mb-4">
        <label class="form-label">Metode Pembayaran</label>
        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control custom-input" required onchange="toggleMetode()">
            <option value="transfer">Transfer Bank</option>
            <option value="tunai">Tunai (Cash)</option>
        </select>
    </div>

    <!-- JUMLAH PEMBAYARAN -->
    <div class="mb-4">
        <label class="form-label">Jumlah Pembayaran</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" name="jumlah" class="form-control custom-input" placeholder="Minimal Rp 100.000" required min="100000" step="1000">
        </div>
    </div>

    <!-- INFO TRANSFER -->
    <div id="info-transfer" class="mb-4 p-3 rounded-4" style="background: #eef7ff; border: 1px dashed #aecce8;">
        <p class="mb-1 small text-primary fw-bold">Rekening Tujuan:</p>
        <p class="mb-0 small text-dark">BCA 1234567890 a.n PetMatch</p>
    </div>

    <!-- BUKTI PEMBAYARAN -->
    <div class="mb-4" id="upload-bukti">
        <label class="form-label" id="label-bukti">Bukti Penerimaan Adopsi</label>
        <input type="file" name="bukti" class="form-control custom-input">
        <span class="file-help">Format: JPG, PNG, PDF (Maks. 2MB). Wajib untuk transfer.</span>
    </div>

    <script>
        function toggleJenis() {
            const jenis = document.getElementById('jenis').value;
            const blokPermintaan = document.getElementById('blok-permintaan');
            const permintaanSelect = document.getElementById('permintaan_id');
            const uploadBukti = document.getElementById('upload-bukti');
            const labelBukti = document.getElementById('label-bukti');

            if (jenis === 'donasi') {
                blokPermintaan.style.display = 'none';
                permintaanSelect.value = '';
                permintaanSelect.setAttribute('disabled', 'disabled');
                labelBukti.textContent = 'Bukti Donasi';
            } else {
                blokPermintaan.style.display = 'block';
                permintaanSelect.removeAttribute('disabled');
                // Kembalikan label untuk mode adopsi
                labelBukti.textContent = 'Bukti Penerimaan Adopsi';
                toggleMetode();
            }
        }

        function toggleMetode() {
            let metode = document.getElementById('metode_pembayaran').value;
            let infoTransfer = document.getElementById('info-transfer');
            let uploadBukti = document.getElementById('upload-bukti');
            
            if(metode == 'tunai') {
                infoTransfer.style.display = 'none';
                uploadBukti.style.display = 'none';
            } else {
                infoTransfer.style.display = 'block';
                // tampilkan bukti untuk transfer baik donasi maupun adopsi
                uploadBukti.style.display = 'block';
            }
        }
        // Run on load
        toggleJenis();
        toggleMetode();
    </script>

    <!-- TOMBOL SUBMIT -->
    <button type="submit" class="btn btn-save">
        Kirim Konfirmasi
    </button>
</form>

        </div>
    </div>
</div>
@endsection
