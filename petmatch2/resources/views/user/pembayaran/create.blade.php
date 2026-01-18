@extends('user.layouts.side')

@section('content')
<div class="container">
    <h4 class="mb-3">Tambah Pembayaran</h4>

    <form action="{{ route('user-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bukti Pembayaran (opsional)</label>
            <input type="file" name="bukti" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
