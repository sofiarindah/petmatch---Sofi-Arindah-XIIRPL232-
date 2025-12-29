@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card p-4 shadow-sm" style="border-radius:15px;">
        <h2 class="fw-bold" style="color:#b33a3a;">Permintaan Ditolak</h2>

        <p class="mt-3">Permintaan adopsi untuk <strong>{{ $permintaan->hewan->nama }}</strong> 
            oleh <strong>{{ $permintaan->user->nama }}</strong> telah <b>ditolak</b>.</p>

        <a href="{{ route('admin.permintaan.index') }}" class="btn btn-danger mt-3">
            Kembali ke daftar
        </a>
    </div>

</div>
@endsection
