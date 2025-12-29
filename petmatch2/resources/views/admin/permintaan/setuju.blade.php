@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="card p-4 shadow-sm" style="border-radius:15px;">
        <h2 class="fw-bold" style="color:#4b7d4b;">Permintaan Disetujui</h2>

        <p class="mt-3">Permintaan adopsi untuk <strong>{{ $permintaan->hewan->nama }}</strong> 
            oleh <strong>{{ $permintaan->user->nama }}</strong> telah <b>disetujui</b>.</p>

        <a href="{{ route('admin.permintaan.index') }}" class="btn btn-success mt-3">
            Kembali ke daftar
        </a>
    </div>

</div>
@endsection
